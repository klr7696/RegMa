import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/ouverts")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/ouverts/" + id)
    .then(response => response.data);
}

function actualise(id) {
    return axios 
    .patch("http://localhost:8000/api/ouverts/" + id);
}

function deleteOuvert(id) {
    return axios
    .delete("http://localhost:8000/api/ouverts/" + id);
}

function create(ouvert) {
    return axios
    .post("http://localhost:8000/api/ouverts/inscription", ouvert)
}

function update(id, ouvert) {
    return axios
    .put("http://localhost:8000/api/ouverts/" + id, ouvert);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteOuvert
};