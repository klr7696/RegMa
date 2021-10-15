import React from 'react';
import { Component } from 'react';

const CreatItem = () => {
    return (
      <div className="page-body">
        <div className="row">
          <div className="col-sm-12">
            <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Nom</label>
                </div>
                <div className="col-sm-3">
                  <input
                    type="text"
                    className="form-control"
                  />
                </div>
                <div className="col-sm-1">
                    <label className="col-form-label">Prénom</label>
                  </div>
                  <div className="col-sm-3">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Matricule</label>
                </div>
                <div className="col-sm-3">
                  <input
                    type="text"
                    className="form-control"
                  />
                </div>
                <div className="col-sm-1">
                    <label className="col-form-label">Confirmer Matricule</label>
                  </div>
                  <div className="col-sm-3">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Email</label>
                </div>
                <div className="col-sm-3">
                  <input
                    type="email"
                    className="form-control"
                  />
                </div>
                <div className="col-sm-1">
                    <label className="col-form-label">Téléphone</label>
                  </div>
                  <div className="col-sm-3">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
              </div>

                <div className="row form-group">
                  <div className="col-sm-2">
                    <label className="col-form-label">Mairie</label>
                  </div>
                  <div className="col-sm-3"> 
                  <select className="form-control">
                    <option value="none">Mairie...</option>
                    <option value="1">Mairie centale</option>
                    <option value="1">Arrondissement 1</option>
                  </select>
                  </div>
                  <div className="col-sm-1">
                    <label className="col-form-label">Rôle</label>
                  </div>
                  <div className="col-sm-3">
                  <select className="form-control">
                                 <option value="1">Rôle...</option>
                                <option value="1">Agent SBU</option>
                                <option value="2">Agent SDE</option>
                </select>
                  </div>
                </div>
                <div className="text-right col-sm-9">
                  <button type="submit" className="btn btn-primary">Enregistrer</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  };
  
  const ConsultItem = () => {
    return (
      <div className="page-body">
        <div className="card-block">
        <h5 className="card-header-text">Listes des Bailleurs de fonds</h5>
          <div className="table-responsive dt-responsive">
            <table
              id="lang-file"
              className="table table-striped table-bordered nowrap"
            >
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Matricule</th>
                  <th>Email</th>
                  <th>Télephone</th>
                  <th>Mairie</th>
                  <th>Rôle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Millogo</td>
                  <td>Ayman</td>
                  <td>A201125</td>
                  <td>Mg@gmail.cm</td>
                  <td>(+226)75858585</td>
                  <td>Mairie Centale</td>
                  <td>Agent SBU</td>
                </tr>
                <tr>
                <td>Sams</td>
                  <td>Ayman</td>
                  <td>A201125</td>
                  <td>Mg@gmail.cm</td>
                  <td>(+226)75858585</td>
                  <td>Mairie Centale</td>
                  <td>Agent SBU</td>
                </tr>
                <tr>
                <td>Kabore</td>
                  <td>Ayman</td>
                  <td>A201125</td>
                  <td>Mg@gmail.cm</td>
                  <td>(+226)75858585</td>
                  <td>Mairie Centale</td>
                  <td>Agent SBU</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    );
  };
   
  class ItemCommande extends Component {
    render() {
      return (
        <section id="exp">
          <div class="product-detail-page">
            <h4 className="card-header">
              <div className="row">
              <div className="text-left col-sm-6">
              Item de commande
            </div>
              
              <div className="text-right col-sm-6">
                  <button className="btn-sm btn-secondary">
                    Gestion 2021
                  </button>
                </div>
              </div>
            </h4>
            <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
              <li className="nav-item">
                <a
                  className="nav-link active f-18 p-b-0"
                  data-toggle="tab"
                  href="#creation"
                  role="tab"
                >
                  Enregistrement
                </a>
                <div className="slide" />
              </li>
  
              <li className="nav-item m-b-0">
                <a
                  className="nav-link f-18 p-b-0"
                  data-toggle="tab"
                  href="#consultation"
                  role="tab"
                >
                  Consultation
                </a>
                <div className="slide" />
              </li>
  
            </ul>
            <div className="card">
              <div className="card-block">
                <div className="tab-content bg-white">
                  <div className="tab-pane active" id="creation" role="tabpanel">
                    <CreatItem />
                  </div>
                  <div className="tab-pane" id="consultation" role="tabpanel">
                    <ConsultItem/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      );
    }
  }
 
export default ItemCommande;