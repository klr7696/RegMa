import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/mairies")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/mairies")
    .then(response => response.data);
}

function deleteMairie(id) {
    return axios
    .delete("http://localhost:8000/api/mairies/" + id);
}

function create(mairie) {
    return axios
    .post("http://localhost:8000/api/mairies", mairie)
}

function update(id, mairie) {
    return axios
    .put("http://localhost:8000/api/mairies/" + id, mairie);
}

export default {
    findAll,
    find,
    update,
    create,
    delete: deleteMairie
};