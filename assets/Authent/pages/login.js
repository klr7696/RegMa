import React from 'react'
const Login = () => {
    return ( 
        <section className="login">
        <div className="container">
        <div  className="main-body">
            <form>
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
                  <select className="form-control ">
                    <option value="">Mairie...</option>
                    <option value="1">Centrale</option>
                    <option value="2">Ard № 1</option>
                    <option value="2">Ard № 2</option>
                  </select>
                  </div>
                 
                <div className="col-sm-6">
                  <select className="form-control ">
                    <option value="">Rôle...</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Agent SBU</option>
                    <option value="2">Agent SDE</option>
                  </select>
                  </div>
                           
                          </div>

                          <div className="form-group">
                            <input
                              type="text"
                              name="identifiant"
                              className="form-control"
                              required
                              placeholder="Identifiant"
                            />
                            <span className="form-bar" />
                          </div>
                          <div className="form-group form-primary">
                            <input
                              type="password"
                              name="password"
                              className="form-control"
                              required
                              placeholder="Mot de Passe"
                            />
                            <span className="form-bar" />
                          </div>
                          <div className="row m-t-30">
                            <div className="col-md-12">
                              <button
                                type="button"
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
                                          aller à{" "}
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
                                              type="button"
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
                          <hr />
                        </div>
                      </div>
                    </div>
                  </div>
            </form>
          </div>
          </div>

    </section>
  
     );
}
 
export default Login;