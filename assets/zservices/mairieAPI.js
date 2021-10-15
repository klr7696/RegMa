import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/mairie_communales")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/mairie_communales")
    .then(response => response.data);
}

function deleteMairie(id) {
    return axios
    .delete("http://localhost:8000/api/mairie_communales/" + id);
}

function create(mairie) {
    return axios
    .post("http://localhost:8000/api/mairie_communales", mairie)
}

function update(id, mairie) {
    return axios
    .put("http://localhost:8000/api/mairie_communales/" + id, mairie);
}

export default {
    findAll,
    find,
    update,
    create,
    delete: deleteMairie
};