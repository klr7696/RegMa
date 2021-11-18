import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/projets")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/projets" + id )
    .then(response => response.data);
}

function actualise(projet) {
    return axios 
    .post("http://localhost:8000/api/projets/actualise", projet);
}

function deleteProjet(id) {
    return axios
    .delete("http://localhost:8000/api/projets/" + id);
}

function create(projet) {
    return axios
    .post("http://localhost:8000/api/projets", projet);
}

function update(id, projet) {
    return axios
    .put("http://localhost:8000/api/projets/" + id, projet);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteProjet
};