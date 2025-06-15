import socket

# Function to process received messages and send responses
def process_message(client_socket):
    received_data = client_socket.recv(1024).decode("ASCII").strip()
    print("--- Received the message ---")
    print(received_data)

    # Unpack the received data into header and message
    decoded_header = received_data[:9].rstrip("\x00")
    decoded_message = received_data[10:].rstrip("\x00")

    # Initialize protocol parameters
    protocol_parameters = {
        "Header": decoded_header,
        "Message Type": "",
        "Message": "",
    }

    # Check if the header is not "TNE20003:"
    if decoded_header != "TNE20003:":
        error_message = "Invalid header"
        protocol_parameters["Message Type"] = "E:"
        protocol_parameters["Message"] = error_message
    else:
        # Check if the message is empty
        if not decoded_message:
            error_message = "Message is empty"
            protocol_parameters["Message Type"] = "E:"
            protocol_parameters["Message"] = error_message
        else:
            protocol_parameters["Message Type"] = "A:"
            protocol_parameters["Message"] = decoded_message

    # Send the response back to the client
    response = f"{protocol_parameters['Header']}{protocol_parameters['Message Type']}:{protocol_parameters['Message']}"
    client_socket.send(response.encode("ASCII"))

    # Display the protocol parameters
    print("\n----- The protocol parameters are -----")
    print(f"Header: {protocol_parameters['Header']}")
    print(f"Message Type: {protocol_parameters['Message Type']}")
    print(f"Message: {protocol_parameters['Message']}")

# Main function
def main():
    local_IP = "127.0.0.1"
    port = 9000

    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server_socket.bind((local_IP, port))
    server_socket.listen(1)

    print(f"Listening on {local_IP}:{port}...")

    while True:
        client_socket, client_address = server_socket.accept()
        print(f"Accepted connection from {client_address}")

        # Process the message and send a response for the connected client
        process_message(client_socket)
        client_socket.close()

if __name__ == "__main__":
    main()
