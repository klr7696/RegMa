import React from 'react'
import HeaderAuth from '../components/HeaderAuth';


const Lock = () => {
    return ( 
      <div id="pcoded" className="pcoded">
      <div className="pcoded-container navbar-wrapper">
        <HeaderAuth />
        <div className="pcoded-main-container">
          <div className="pcoded-wrapper">

              <div className="pcoded-inner-content">
            
        <section className="login">
            <div className="container">
              <div className="row">
                <div className="col-sm-12">
                  {/* Login card start */}
                  <form className="md-float-material form-material" className="j-forms">
                    <div className="auth-box card">
                      <div className="card-block">
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
                          <form className="md-float-material form-material" className="j-forms">
                            <h3 className="text-center">
                              <i className="feather icon-lock text-primary f-60 p-t-15 p-b-20 d-block" />
                            </h3>
                            <div className="card-block">
                            <div className="form-group form-primary">
                          <input
                            type="password"
                            name="password"
                            className="form-control"
                            required
                            placeholder="Mot de passe"
                          />
                          <span className="form-bar" />
                        </div>
                        <div className="row">
                          <div className="col-md-12">
                            <button
                              type="button"
                              className="btn btn-primary btn-md btn-block waves-effect text-center m-b-20"
                            >
                              <i className="icofont icofont-lock" />{" "}
                              Déverrouiller{" "}
                            </button>
                          </div>
                        </div>
                        <p className="text-inverse text-right">
                          Aller à <a href="#/login">se connecter</a>
                        </p>
                        </div>
                        </form>
                          </div>
                        </div>
                       
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>
   </div></div></div></div></div>
     );
}
 
export default Lock;