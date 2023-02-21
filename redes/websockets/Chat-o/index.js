const express = require('express');
const http = require('http');
const {Server} = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = new Server(server);

const path = require('path');
app.use('/static', express.static(path.join(__dirname, 'public')))

app.get('/', (request, response) => {
    response.sendFile(__dirname + '/index.html');
});

io.on('connection', (socket) => {
    socket.on('chat message', msg => {
        io.emit('chat message', socket.id, msg);
    })

    socket.on('disconnect', () => {
        console.log(`Connection ended - ${socket.id}`);
    });
});

server.listen(3000, () => {
    console.log('Listening on 3000...');
})