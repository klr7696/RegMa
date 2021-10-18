import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/bailleur_fonds")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/bailleur_fonds")
    .then(response => response.data);
}

function deleteBailleur(id) {
    return axios
    .delete("http://localhost:8000/api/bailleur_fonds/" + id);
}

function create(bailleur) {
    return axios
    .post("http://localhost:8000/api/bailleur_fonds", bailleur)
}

function update(id, bailleur) {
    return axios
    .put("http://localhost:8000/api/bailleur_fonds/" + id, bailleur);
}

export default {
    findAll,
    find,
    update,
    create,
    delete: deleteBailleur
};