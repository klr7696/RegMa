import axios from 'axios';
import jwtDecode from 'jwt-decode';

function logout() {
    window.localStorage.removeItem("authToken");
    delete axios.defaults.headers["Authorization"];
}

function authenticate(credentials) {
    return axios
  .post("http://localhost:8000/api/login_check", credentials
  )
  .then(response => console.log(response))
  
}
function setAxiosToken() {
    axios.defaults.headers["Autorization"] = "Bearer " + token;
}

function setup() {
const token = window.localStorage.getItem("authToken");
if (token) {
    const {exp: expiration} = jwtDecode(token);
    if (expiration * 1000 > new Date().getTime()) {
        setAxiosToken(token);
    }
}
}

function isAuthenticated() {
    if (token) {
        const {exp: expiration} = jwtDecode(token);
        if (expiration * 1000 > new Date().getTime()) {
       return true;
        }   
       return false;
    }
    return false;
}
export default {
    authenticate,
    logout, 
    setup,
    isAuthenticated
}