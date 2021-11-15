import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/ressources")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/ressources" + id )
    .then(response => response.data);
}

function actualise(ressource) {
    return axios 
    .post("http://localhost:8000/api/ressources/actualise", ressource);
}

function deleteRessource(id) {
    return axios
    .delete("http://localhost:8000/api/ressources/" + id);
}

function create(ressource) {
    return axios
    .post("http://localhost:8000/api/ressources/inscription", ressource);
}

function update(id, ressource) {
    return axios
    .put("http://localhost:8000/api/ressources/" + id, ressource);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteRessource
};