import React, { Component } from "react";

const InscriFinanc = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-11">
          <div className="card-block">
          <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Bailleur *</label>
                </div>
                <div className="col-sm-2">
                  <select className="form-control">
                  <option selected="">...</option>
                    <option value="1">Etat</option>
                    <option value="2">Commune</option>
                  </select>
                </div>
                <div className="col-sm-1">
                  <label className="col-form-label">Objet *</label>
                </div>
                <div className="col-sm-3">
                  <select className="form-control">
                    <option selected="">...</option>
                    <option value="1">Fonctionnement</option>
                    <option value="2">Investissement</option>
                  </select>
                </div>
                <div className="col-sm-1">
                  <label className="col-form-label">Mode *</label>
                </div>
                <div className="col-sm-3">
                  <select className="form-control">
                    <option selected="">...</option>
                    <option value="1">Subvention</option>
                    <option value="2">Dotation</option>
                    <option value="1">Emprunts</option>
                    <option value="2">Recette propres</option>
                    <option value="1">Dons</option>
                  </select>
                </div>
                </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Montant * (FCFA)</label>
                </div>
                <div className="col-sm-6">
                  <input type="number" className="form-control" />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea
                    type="text"
                    className="form-control"
                  />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">Inscrire</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

const ActuliFinanc = () => {
  return (
    <div className="page-body">
    <div className="row">
      <div className="col-sm-11">
        <div className="card-block">
        <form>
            <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Bailleur *</label>
              </div>
              <div className="col-sm-2">
                <select className="form-control">
                <option selected="">...</option>
                  <option value="1">Etat</option>
                  <option value="2">Commune</option>
                </select>
              </div>
              <div className="col-sm-1">
                <label className="col-form-label">Objet *</label>
              </div>
              <div className="col-sm-3">
                <select className="form-control">
                  <option selected="">...</option>
                  <option value="1">Fonctionnement</option>
                  <option value="2">Investissement</option>
                </select>
              </div>
              </div>
            <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Montant actuel (FCFA)</label>
              </div>
              <div className="col-sm-6">
                <input type="number" className="form-control" readonly=""/>
              </div>
            </div>
            <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Nouveau montant * (FCFA)</label>
              </div>
              <div className="col-sm-6">
                <input type="number" className="form-control" />
              </div>
            </div>
            <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Description</label>
              </div>
              <div className="col-sm-10">
                <textarea
                  type="text"
                  className="form-control"
                />
              </div>
            </div>
            <div className="text-right col-sm-12">
              <button type="submit" className="btn btn-primary">Actualiser</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  );
};

const ConsultRessourc = () => {
  return (
    <div class="card-block">
     
        <h5 class="card-header-text">Listes des financements</h5>
        <div className="table-responsive dt-responsive">
          <table
            id="lang-file"
            className="table table-striped table-bordered nowrap"
          >
            <thead>
              <tr>
                <th>Bailleur</th>
                <th>Objet</th>
                <th>Mode</th>
                <th>Montant</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Commune</td>
                <td>Fonctionnement</td>
                <td>Subvention</td>
                <td>3 000 000</td>
                <td>description du finacement</td>
                <td>Actualisé</td>
                <td>
            <a href="#!" className="m-r-45 text-muted" data-toggle="tooltip" data-placement="top" data-original-title="Modifier"><i className="icofont icofont-ui-edit" /></a>
            </td>
              </tr>
              <tr>
                <td>Etat</td>
                <td>Investissement</td>
                <td>Dotations</td>
                <td>320 800 000</td>
                <td>description du finacement</td>
                <td>Non Actualisé</td>
                <td>
            <a href="#!" className="m-r-45 text-muted" data-toggle="tooltip" data-placement="top" data-original-title="Modifier"><i className="icofont icofont-ui-edit" /></a>
            </td>
              </tr>
              <tr>
                <td>Partenaire financier</td>
                <td>Fonctionnement</td>
                <td>Subventions</td>
                <td>500 800</td>
                <td>description du finacement</td>
                <td>320 800</td>
                <td>
            <a href="#!" className="m-r-45 text-muted" data-toggle="tooltip" data-placement="top" data-original-title="Modifier"><i className="icofont icofont-ui-edit" /></a>
            </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
  );
};

class RessourceFi extends Component {
  render() {
    return (
      <section id="exp">
        <div className="product-detail-page">
        <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            RESSOURCE FINANCIERE 
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
                href="#inscription"
                role="tab"
              >
                Inscription
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#actualisation"
                role="tab"
              >
                Actualisation
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
              {/* Tab panes */}
              <div className="tab-content bg-white">
                <div
                  className="tab-pane active"
                  id="inscription"
                  role="tabpanel"
                >
                  <InscriFinanc />
                </div>
                <div className="tab-pane" id="actualisation" role="tabpanel">
                  <ActuliFinanc />
                </div>
                <div className="tab-pane" id="consultation" role="tabpanel">
                  <ConsultRessourc />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }
}

export default RessourceFi;
