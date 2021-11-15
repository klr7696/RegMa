import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/autorisations")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/autorisations/" + id )
    .then(response => response.data);
}

function actualise(autorisation) {
    return axios 
    .post("http://localhost:8000/api/autorisations/actualise", autorisation);
}

function deleteAutorisation(id) {
    return axios
    .delete("http://localhost:8000/api/autorisations/" + id);
}

function create(autorisation) {
    return axios
    .post("http://localhost:8000/api/autorisations/inscription", autorisation);
}

function update(id, ressource) {
    return axios
    .put("http://localhost:8000/api/autorisations/" + id, autorisation);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteAutorisation
};