import React, { Component } from "react";

const CreatDivision = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro
                  </label>
                </div>
                <div className="col-sm-2">
                  <input
                    type="text"
                    className="form-control autonumber"
                    placeholder="**"
                    data-v-max={99}
                    data-v-min={0}
                  />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Libellé *</label>
                </div>
                <div className="col-sm-10">
                  <input type="text" className="form-control" />
                </div>
              </div>
             
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea type="text" className="form-control" />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

const CreatGroupe = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro
                  </label>
                </div>
                <div className="col-sm-2">
                  <input
                    type="text"
                    className="form-control autonumber"
                    placeholder="***"
                    data-v-max={999}
                    data-v-min={0}
                  />
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro de division *
                  </label>
                </div>
                <div className="col-sm-2">
                  <select className="form-control ">
                    <option selected="">...</option>
                    <option value="1">10</option>
                    <option value="2">20</option>
                  </select>
                  </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Libellé</label>
                </div>
                <div className="col-sm-10">
                  <input type="text" className="form-control" />
                </div>
              </div>
             
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea type="text" className="form-control" />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

const CreatClasse = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro
                  </label>
                </div>
                <div className="col-sm-2">
                  <input
                    type="text"
                    className="form-control autonumber"
                    placeholder="****"
                    data-v-max={9999}
                    data-v-min={0}
                  />
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro du groupe *
                  </label>
                </div>
                <div className="col-sm-2">
                  <select className="form-control ">
                    <option selected="">...</option>
                    <option value="1">001</option>
                    <option value="2">002</option>
                  </select>
                  </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Libellé</label>
                </div>
                <div className="col-sm-10">
                  <input type="text" className="form-control" />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea type="text" className="form-control" />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

const Consult = () => {
  return (
    <div className="page-body">
          <div className="card-block">
          <h5 className="card-header-text">Liste de Nomenclatures</h5>
      <div className="table-responsive dt-responsive">
        <table
          id="lang-file"
          className="table table-striped table-bordered nowrap"
        >
      <thead>
                  <tr>
                    <th>Num</th>
                    <th>Libéllé</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr >
                      <td>60</td>
                      <td>Frais de transport</td>
                      <td>
                          <a href="#!" className="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i className="icofont icofont-ui-edit" /></a>
                      </td>
                    </tr>
                   
                  </tbody>
              </table>
         
             </div>
        </div>
    </div>
  );
};

class CompteFonction extends Component {
  render() {
    return (
      <section id="exp">
        <div class="product-detail-page">
        <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
             NOMENCLATURE / COMPTES DE FONCTION 
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
                href="#division"
                role="tab"
              >
                Division
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#groupe"
                role="tab"
              >
                Groupe
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#classe"
                role="tab"
              >
                Classe
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#consult"
                role="tab"
              >
                Consulter
              </a>
              <div className="slide" />
            </li>
          </ul>
          <div className="card">
            <div className="card-block">
              {/* Tab panes */}
              <div className="tab-content bg-white">
                <div className="tab-pane active" id="division" role="tabpanel">
                  <CreatDivision />
                </div>
                <div className="tab-pane" id="groupe" role="tabpanel">
                  <CreatGroupe />
                </div>
                <div className="tab-pane" id="classe" role="tabpanel">
                  <CreatClasse />
                </div>
                <div className="tab-pane" id="consult" role="tabpanel">
                  <Consult/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }
}

export default CompteFonction;
