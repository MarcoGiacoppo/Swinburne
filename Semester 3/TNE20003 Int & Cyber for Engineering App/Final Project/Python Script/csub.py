import paho.mqtt.client as mqtt

# MQTT broker details
broker = 'rule28.i4t.swin.edu.au'
port = 1883  # Default MQTT port

# Client information
client_id = "SubscriberClient"
username = "104071453"
password = "104071453"

# Topics
threat_topic = "104071453/threats"
public_topic = "public/#"  # Subscribe to all sub-topics under "public"

# Callback function when the client connects to the broker
def on_connect(client, userdata, flags, rc):
    if rc == 0:
        print(f"\nConnected to MQTT Broker. Code: {rc}")
        client.subscribe(threat_topic)
        client.subscribe(public_topic)
    else:
        print(f"\nFailed to connect. Return code: {rc}")

# Callback function when a message is received
def on_message(client, userdata, msg):
    showLog(client)
    print("\n===================")
    print(f"Received message on:")
    print(f"Topic: {msg.topic}")
    print(f"Message: {msg.payload.decode('utf-8')}")
    print("===================\n\n")

# Function to connect to the MQTT broker
def connect_mqtt() -> mqtt.Client:
    client = mqtt.Client(client_id)
    client.username_pw_set(username, password)
    client.on_connect = on_connect
    client.on_message = on_message
    client.connect(broker, port)
    return client

# Function to display MQTT logs
def showLog(client: mqtt.Client) -> None:
    def on_log(client, usrData, level, buf):
        print(f"Logs: {buf}")
    client.on_log = on_log

if __name__ == "__main__":
    mqtt_client = connect_mqtt()
    mqtt_client.loop_forever()
