import socket

# Function to send a message to the server
def send_message(local_IP, port, header, message):
    client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    
    try:
        client_socket.connect((local_IP, port))
        data = f"{header}{message}"
        client_socket.send(data.encode("ASCII"))

        response = client_socket.recv(1024).decode("ASCII")
        print("----- The server reply -----")
        print(response)
    except Exception as e:
        print(f"Error: {e}")
    finally:
        client_socket.close()

# Main function
def main():
    local_IP = "127.0.0.1"
    port = 9000

    header, message = "TNE20003:", " SECOND"

    send_message(local_IP, port, header, message)

if __name__ == "__main__":
    main()
