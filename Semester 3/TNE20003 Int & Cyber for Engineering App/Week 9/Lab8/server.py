import socket
import struct

# Function to process received messages and send responses
def process_message(server_socket, received_data, address):
    # Unpack the received data into header and message
    header, message = struct.unpack("10s 5s", received_data)
    
    # Decode the header and message, removing null bytes
    decoded_header = header.decode("ASCII").rstrip("\x00")
    decoded_message = message.decode("ASCII").rstrip("\x00")

    # Check if the header is not "TNE20003"
    if decoded_header != "TNE20003:":
        error_message = " Invalid header"
        response = f"TNE20003:E:{error_message}"
    # Check if the message is empty
    elif not decoded_message:
        error_message = "Message is empty"
        response = f"TNE20003:E:{error_message}"
    else:
        response = f"TNE20003:A:{decoded_message}"

    # Send the response back to the client  
    server_socket.sendto(response.encode("ASCII"), address)

    # Display the received message
    print(f"{decoded_header}{decoded_message}")

def main():
    local_IP = "127.0.0.1"
    port = 9000

    # Create a UDP socket and bind it to the local IP and port
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    server_socket.bind((local_IP, port))

    while True:
        # Receive a message from the client
        received_data, address = server_socket.recvfrom(1024)
        print("--- Received the message ---")

        # Process the received message and send a response
        process_message(server_socket, received_data, address)

if __name__ == "__main__":
    main()
