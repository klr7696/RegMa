import React from 'react';
import { Component } from 'react';

const CreatProjet = () => {
    return (
      <div className="page-body">
        <div className="row">
          <div className="col-sm-12">
            <div className="card-block">
            <form>
              <div className="row form-group">
              <div className="col-sm-2">
                    <label className="col-form-label">Objet du marché</label>
                  </div>
                  <div className="col-sm-3"> 
                  <select className="form-control">
                    <option value="none">Choisir...</option>
                    <option value="field-1">Avénant</option>
                    <option value="field-2">Marché</option>
                  </select>
                  </div>
              </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Numéro du projet</label>
                  </div>
                  <div className="col-sm-3">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Référence du projet</label>
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
                    <label className="col-form-label">Priorité</label>
                  </div>
                  <div className="col-sm-3">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Spécificité</label>
                  </div>
                  <div className="col-sm-3">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
                </div>
                <div className="text-right col-sm-10">
                  <button type="submit" className="btn btn-primary">Créer</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  };
  
  const ConsultProjet = () => {
    return (
      <div className="page-body">
        <div className="card-block">
        <h5 className="card-header-text">Listes des Contrats</h5>
          <div className="table-responsive dt-responsive">
            <table
              id="lang-file"
              className="table table-striped table-bordered nowrap"
            >
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Montant minimum</th>
                  <th>Montant maximun</th>
                  <th>Numéro</th>
                  <th>Réference</th>
                  <th>Date d'approbation</th>
                  <th>Date de Notification</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Marché</td>
                  <td>15000000</td>
                  <td>20000000</td>
                  <td>k45555</td>
                  <td>mp-dd-co2021</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>descrip co</td>
                </tr>
                <tr>
                <td>Avénant</td>
                  <td>15000000</td>
                  <td>20000000</td>
                  <td>k45555</td>
                  <td>mp-dd-co2021</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>descrip co</td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    );
  };
   
  class Projet extends Component {
    render() {
      return (
        <section id="exp">
          <div class="product-detail-page">
          <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
           PROJET DE MARCHE
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
                  Création
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
                    <CreatProjet />
                  </div>
                  <div className="tab-pane" id="consultation" role="tabpanel">
                    <ConsultProjet/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      );
    }
  }
 
export default Projet;