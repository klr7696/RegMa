import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/ressources")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/ressources")
    .then(response => response.data);
}

function actualise(id) {
    return axios 
    .patch("http://localhost:8000/api/ressources/" + id);
}

function deleteRessource(id) {
    return axios
    .delete("http://localhost:8000/api/ressources/" + id);
}

function create(ressource) {
    return axios
    .post("http://localhost:8000/api/ressources", ressource)
}

function update(id, ressource) {
    return axios
    .patch("http://localhost:8000/api/ressources/" + id, ressource);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteRessource
};