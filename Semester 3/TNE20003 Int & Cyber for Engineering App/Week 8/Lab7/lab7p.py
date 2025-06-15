import socket

target_host = "www.google.com"
target_port = 80

#AF_INET specifies we're using IPv4, SOCK_STREAM indicates we're creating a TCP socket for stream-based communication
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client.connect((target_host, target_port))

request = "GET / HTTP/1.0\r\nHost: {}\r\n\r\n".format(target_host)

#Convert the request string to bytes before sending it
client.send(request.encode())

#b is byte string in python
response = b""
while True:
    data = client.recv(4096) #receives data in a chuncks of 4096 bytes
    if not data:
        break
    response += data

print(response.decode())

#clopse the socket connection
client.close()
