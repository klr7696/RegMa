import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/nomenclatures")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/nomenclatures")
    .then(response => response.data);
}

function actualise(id) {
    return axios 
    .patch("http://localhost:8000/api/nomenclatures/" + id);
}

function deleteNomenclature(id) {
    return axios
    .delete("http://localhost:8000/api/nomenclatures/" + id);
}

function create(nomenclature) {
    return axios
    .post("http://localhost:8000/api/nomenclatures", nomenclature)
}

function update(id, nomenclature) {
    return axios
    .put("http://localhost:8000/api/nomenclatures/" + id, nomenclature);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteNomenclature
};