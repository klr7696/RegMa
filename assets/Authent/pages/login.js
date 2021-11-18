import React, {useState, useEffect} from 'react'
import HeaderAuth from '../components/HeaderAuth';
import axios from 'axios';
import { toast } from "react-toastify";

const Login = ({onLogin, history}) => {

  const [credentials, setCredentials]= useState(
    {
      username: "",
      password: "",
      mairieCommunale: "",
      role: ""
    }
  );

  const [error, setError] = useState("");

  const [mairies, setMairies] = useState([]);
    
  const fetchMairies = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/mairies")
  .then(response => response.data["hydra:member"]);
    setMairies(data);
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchMairies();
  }, []);


  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setCredentials({...credentials, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();
    console.log(credentials)
try {
 // await AuthAPI.authenticate(credentials);
  setError("");
 // onLogin(true);
  if (credentials.role=="admi") {
    history.replace("/admin")
    toast.success("Bienvenue à vous")
  }
  if (credentials.role=="sbu") {
    history.replace("/sbu")
    toast.success("Bienvenue à vous")
  }
  if (credentials.role=="scp") {
    history.replace("/scp")
    toast.success("Bienvenue à vous")
  }
  if (credentials.role=="sco") {
    history.replace("/sco")
    toast.success("Bienvenue à vous")
  }
  if (credentials.role=="sde") {
    history.replace("/sde")
    toast.success("Bienvenue à vous")
  }
 
  } catch(error) {
    setError(" ");
    toast.error("les informations ne corespondent pas");
  }
  };

    return ( 
      <div id="pcoded" className="pcoded">
      <div className="pcoded-container navbar-wrapper">
        <HeaderAuth />
        <div className="pcoded-main-container">
          <div className="pcoded-wrapper">

              <div className="pcoded-inner-content">
            
        <section className="login">
        <div className="container">
        <div  className="main-body">
            <form onSubmit={handleSubmit}>
                  <div className="row">
                    <div className="col-md-6">
                      <div className=" col-md-9">
                        <img
                          src="..\assets\images\bobo.png"
                          className="crop-not-movable img-fluid"
                        />
                      </div>
                    </div>

                    <div className="col-md-6">
                      <div className=" card-block">
                   
                        <div className="card card-block">
                          <div className="row m-b-20">
                            <div className="col-md-12">
                              <h3 className="text-center">S'authentifier</h3>
                            </div>
                          </div>

                          <div className="row form-group">
                          
                <div className="col-sm-6">
                <select 
                  onChange={handleChange} 
                  name="mairieCommunale"
                  value={credentials.mairieCommunale}
                  className="form-control"
                  required
                 ><option value="">...</option>
                   {mairies.map(mairie => <option key={mairie.id} value={mairie.id}>
                       {mairie.abbreviationMairie} 
                     </option>)}
                   </select>
                  </div>
                 
                <div className="col-sm-6">
                <select 
                  onChange={handleChange} 
                  name="role"
                  id="role"
                  value={credentials.role}
                  className="form-control"
                 >
                   <option value="">Rôle...</option>
                    <option value="admi">Administrateur</option>
                    <option value="sbu">Agent SBU</option>
                    <option value="scp">Agent SCP</option>
                    <option value="sco">Agent SCO</option>
                    <option value="sde">Agent SDE</option>
                    </select>
                  </div>
                         
                          </div>

                          <div className="form-group">
                          <input 
                           placeholder="Matricule"
                            onChange={handleChange} 
                            name="username"
                            type="text"
                            value={credentials.username}
                            className={"form-control" + (error && " is-invalid")}
                            required
                          />
                          {error && <p className="invalid-feedback">{error}</p>}
                            <span className="form-bar" />
                          </div>
                          <div className="form-group form-primary">
                          <input 
                           placeholder="Mot de Passe"
                            onChange={handleChange} 
                            name="password"
                            type="password"
                            value={credentials.password}
                            className={"form-control" + (error && " is-invalid")}
                            required
                          />
                          {error && <p className="invalid-feedback">{error}</p>}
                            <span className="form-bar" />
                          </div>
                          <div className="row m-t-30">
                            <div className="col-md-12">
                              <button
                                type="submit"
                                className="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20"
                              >
                                Se connecter
                              </button>
                            </div>
                          </div>
                          <div className="row m-t-25 text-left">
                            <div className="col-12">
                              <div className="forgot-phone text-right f-right">
                                <a
                                  href="auth-reset-password.htm"
                                  className="text-right f-w-600"
                                  data-toggle="modal"
                                  data-target="#reset-password"
                                >
                                  Mot de passe oublié?
                                </a>
                              </div>
                            </div>
                           
                          </div>
                          <hr />
                        </div>
                      </div>
                    </div>
                  </div>
            </form>
            <div
                              id="reset-password"
                              className="modal fade"
                              role="dialog"
                            >
                              <div className="modal-dialog">
                                <div className="login-card card-block login-card-modal">
                                  <form>
                                    <div className="card m-t-15">
                                      <div className="auth-box card-block">
                                        <div className="row m-b-0">
                                          <div className="col-md-12">
                                            <h3 className="text-left">
                                              Restaurer votre mot de passe
                                            </h3>
                                          </div>
                                        </div>
                                        <p
                                          className="text-inverse b-b-default text-right"
                                          data-dismiss="modal"
                                        >
                                          aller à
                                          <a href="#/login">SE CONNECTER</a>
                                        </p>
                                        <div className="input-group">
                                          <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Votre adresse email"
                                          />
                                          <span className="md-line" />
                                        </div>
                                        <div className="row">
                                          <div className="col-md-12">
                                            <button
                                              type="submit"
                                              className="btn btn-primary btn-md btn-block waves-effect text-center"
                                            >
                                              Confirmer
                                            </button>
                                          </div>
                                        </div>
                                        <hr />
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
          </div>
          </div>

    </section>
    </div></div></div></div></div>
  
     );
}
 
export default Login;