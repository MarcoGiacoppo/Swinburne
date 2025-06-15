import paho.mqtt.client as mqtt
import time

# MQTT broker details
broker = 'rule28.i4t.swin.edu.au'
port = 1883  # Default MQTT port

# Client information
client_id = "PubSubClient"
username = "104071453"
password = "104071453"

# Topics
threat_topic = "104071453/threats" 
public_topic = "public/#"  # Subscribe to all sub-topics under "public"

message_timeout = 10  # Timeout (seconds) for waiting to receive a message

message_received = False

# Callback function when the cliuent connects to the broker
def on_connect(client, userdata, flags, rc):
    if rc == 0:
        print(f"Connected to MQTT Broker. Code: {rc}")
        client.subscribe(threat_topic)
        client.subscribe(public_topic)
    else:
        print(f"Failed to connect. Return code: {rc}")

# Callback function when a message is received
def on_message(client, userdata, msg):
    global message_received
    print(f"Received message on topic: {msg.topic}")
    print(f"Message: {msg.payload.decode('utf-8')}")
    message_received = True

# Function to connect to the MQTT broker
def connect_mqtt() -> mqtt.Client:
    client = mqtt.Client(client_id)
    client.username_pw_set(username, password)
    client.on_connect = on_connect
    client.on_message = on_message
    client.connect(broker, port)
    return client

# Function to public a specified number of messages
def publish_threats(client: mqtt.Client, threat_data):
    for threat in threat_data:
        client.publish(threat_topic, threat)
        print(f"Published threat information: {threat}")
        time.sleep(2)

# Function to disconnect the MQTT client
def disconnect_mqtt(client: mqtt.Client):
    client.disconnect()
    client.loop_stop()
    print("Disconnected from MQTT Broker")

if __name__ == "__main__":
    mqtt_client = connect_mqtt()
    mqtt_client.loop_start()

    # Threat data to publish
    threat_data = [
        "New malware discovered in the wild",
        "Data breach detected in a major company",
        "Phishing attack reported in the organization",
        "Critical software vulnerability identified",
    ]

    # Start publishing threat data
    publish_threats(mqtt_client, threat_data)

    # Wait for a message to be received
    start_time = time.time()
    while not message_received:
        if time.time() - start_time > message_timeout:
            print(f"Message not received within {message_timeout} seconds.")
            break

    # Disconnect the client when done
    disconnect_mqtt(mqtt_client)
