import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/registres")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/registres/" + id)
    .then(response => response.data);
}

function actualise(id) {
    return axios 
    .patch("http://localhost:8000/api/registres/" + id);
}

function deleteRegistre(id) {
    return axios
    .delete("http://localhost:8000/api/registres/" + id);
}

function create(registre) {
    return axios
    .post("http://localhost:8000/api/registres/ouvrir", registre)
}

function update(id, registre) {
    return axios
    .put("http://localhost:8000/api/registres/" + id, registre);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteRegistre
};