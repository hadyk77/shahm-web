const express = require('express');
const socket = require('socket.io');
const http = require('http');
const fs = require('fs');
let app = express();
let axios = require("axios");
const https = require("https");
const logger = require('pino')()
require('dotenv').config();

let server = null;

if (process.env.NODE_ENV === "local") {
    server = http.createServer(app);
    axios.defaults.httpsAgent = new https.Agent({
        rejectUnauthorized: false,
    })
}

if (process.env.NODE_ENV === "production") {
    server = https.createServer({
        key: fs.readFileSync(process.env.KEY_PATH),
        cert: fs.readFileSync(process.env.CERT_PATH),
        ca: fs.readFileSync(process.env.CA_PATH),

        requestCert: false,
        rejectUnauthorized: false
    }, app);
}


const io = socket(server, {
    cors: {
        origin: process.env.CROSS_ORIGIN,
        methods: ["GET", "POST"],
        transports: ['websocket', 'polling'],
        credentials: true
    },
    allowEIO3: true
});


io.on('connection', (socket) => {

    logger.info(`Socket with id = ${socket.id}`);

    socket.emit("message", "Welcome to socket io from shahm app");

    socket.on("message", (data) => {
        logger.info(data);
    });

    socket.on("joinOrderChatRoom", ({chat_uuid}) => {
        logger.info("joinOrderChatRoom => Chat UUID => " + chat_uuid);
        socket.join(chat_uuid);
    });

    socket.on("sendOrderChatMessage", async ({order_id, token, chat_uuid, message_id}) => {
        logger.info("sendOrderChatMessage => Chat UUID => " + chat_uuid);
        logger.info("sendOrderChatMessage => Order Id => " + order_id);
        logger.info("sendOrderChatMessage => Message Id => " + message_id);
        logger.info("sendOrderChatMessage => TOKEN => " + token);
        await axios.get(`${process.env.BASE_URL}/chat/${order_id}/message/${message_id}`, {
            headers: {
                "Authorization": `Bearer ${token}`
            }
        }).then(response => {
            socket.to(chat_uuid).emit("newOrderChatMessage", response.data)
        }).catch(error => {
            console.log(error);
        });
    });

});

const PORT = process.env.PORT || 3001;

server.listen(PORT, function () {
    console.log("SOCKET RUN ON http://localhost:3001/")
});

app.use(express.static(__dirname + '/public'));

app.get("/", (req, res) => {
    res.render("index.html");
});
