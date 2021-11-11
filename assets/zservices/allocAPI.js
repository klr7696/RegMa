import axios from "axios";

function findAll() {
    return axios
    .get("http://localhost:8000/api/allocations")
    .then(response => response.data["hydra:member"]);
}

function find(id) {
    return axios 
    .get("http://localhost:8000/api/allocations/" + id)
    .then(response => response.data);
}

function actualise(id) {
    return axios 
    .patch("http://localhost:8000/api/allocations/" + id);
}

function deleteAllocation(id) {
    return axios
    .delete("http://localhost:8000/api/allocations/" + id);
}

function create(allocation) {
    return axios
    .post("http://localhost:8000/api/allocations/inscription", allocation)
}

function update(id, allocation) {
    return axios
    .put("http://localhost:8000/api/allocations/" + id, allocation);
}

export default {
    findAll,
    find,
    update,
    create,
    actualise,
    delete: deleteAllocation
};