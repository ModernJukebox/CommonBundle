const express = require("express");
const app = express();

app.use(express.urlencoded({ extended: false }))
app.use(express.json());

let counter = 0;
const storage = new Map();

function getNextId() {
    counter += 1;

    return counter;
}

app.get('/post/:postId', (req, res) => {
    const postId = req.params.postId;

    console.log("get", postId);

    if (storage.has(postId)) {
        return res.json(storage.get(postId));
    } else {
        return res.status(404).send("Post not found");
    }
});

app.get('/post', (req, res) => {
    const posts = [];
    const keys = storage.keys();

    console.log("getAll");

    for (let key of keys) {
        posts.push(storage.get(key));
    }

    return res.json(posts);
});

app.post('/clear', (req, res) => {
    storage.clear();
    counter = 0;

    console.log("clear");

    return res.json("Cleared");
});

app.post("/post", (req, res, next) => {
    const data = req.body;
    const id = getNextId();

    const entity = {
        ...data,
        id,
    };

    console.log("post", entity);

    storage.set(id.toString(), entity);

    return res.status(201).json(storage.get(id.toString()));
});

app.listen(80, '0.0.0.0');
