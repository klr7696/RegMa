import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/lots")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/lots" + id )
    .then(response => response.data);
}

function actualise(lot) {
    return axios 
    .post("http://localhost:8000/api/lots/actualise", lot);
}

function deleteLot(id) {
    return axios
    .delete("http://localhost:8000/api/lots/" + id);
}

function create(lot) {
    return axios
    .post("http://localhost:8000/api/lots", lot);
}

function update(id, lot) {
    return axios
    .put("http://localhost:8000/api/lots/" + id, lot);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteLot
};