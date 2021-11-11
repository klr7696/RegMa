import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/bailleurs/1")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/bailleurs")
    .then(response => response.data);
}

function deleteBailleur(id) {
    return axios
    .delete("http://localhost:8000/api/bailleurs/" + id);
}

function create(bailleur) {
    return axios
    .post("http://localhost:8000/api/bailleurs", bailleur)
}

function update(id, bailleur) {
    return axios
    .patch("http://localhost:8000/api/bailleurs/" + id, bailleur);
}

export default {
    findAll,
    find,
    update,
    create,
    delete: deleteBailleur
};