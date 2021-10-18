import React, { Component } from "react";

const InscriFinanc = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
          <form action="#">
              <div className="row form-group">
              <div className="col-sm-2">
                  <label className="col-form-label">Choix</label>
                </div>
                <div className="col-sm-2">
                <label className="input select">
                  <select className="form-control">
                    <option selected=""> Bailleur</option>
                    <option value="1">Etat</option>
                    <option value="2">Commune</option>
                  </select>
                </label>
                </div>

                <div className="col-sm-2">
                <label className="input select">
                  <select className="form-control">
                    <option selected="">Compte</option>
                    <option value="1">60</option>
                    <option value="2">61</option>
                  </select>

                  </label>
                </div>

                <div className="col-sm-2">
                <label className="input select">
                  <select className="form-control">
                    <option selected="">Sous-compte</option>
                    <option value="1">601</option>
                    <option value="2">6010</option>
                    <option value="2">602</option>
                  </select>
                 
                  </label>
                </div>

                <div className="col-sm-3">
                <label className="input select">
                  <select className="form-control">
                    <option selected="">Mairie</option>
                    <option value="1">Mairie centrale</option>
                    <option value="2">Arrondissement 1</option>
                    <option value="3">Arrondissement 2</option>
                  </select>
                
                  </label>
                </div>
               </div>
              
              <div className="row form-group">
              <div className="col-sm-2">
                  <label className="col-form-label">Montant</label>
                </div>
                <div className="col-sm-9">
                  <input type="text" className="form-control" />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Montant alloué</label>
                </div>
                <div className="col-sm-9">
                  <input type="text" className="form-control" />
                </div>
              </div>
              <div className="text-right col-sm-11">
                <button type="submit" className="btn btn-primary">
                  Inscrire
                </button>
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
        <div className="col-sm-12">
          <div className="card-block">
            <form action="#" method="post" className="j-forms" noValidate>
              
          <div className="content">
          <div className="text-right">
                <button className="btn btn-danger">
                  STATUS
                </button>
              </div>
        
            <div className="unit">
              <h4>Listes des financement à actualiser</h4>
              <label className="input select" id="show-elements-select">
                <select>
                  <option value="none">selectionner le financement...</option>
                  <option value="field-1">Bailleur 1| montant 1</option>
                  <option value="field-2">Bailleur 2| montant 2</option>
                </select>
                <i />
              </label>
            </div>
           
            <div className="unit hidden" id="field-1">
              <div className="input">
                <input type="text" placeholder="Nouveau montant" />
              </div>
            </div>
           
            <div className="unit hidden" id="field-2">
              <div className="input">
                <input type="text" placeholder="Nouveau montant" />
              </div>
            </div>
           
          </div>
          <div className="footer">
            <button type="submit" className="btn btn-primary">Actualiser</button>
          </div>
          {/* end /.footer */}
  </form>
</div></div></div></div>
  );
};

class Allocation extends Component {
  render() {
    return (
      <section id="exp">
        <div class="product-detail-page">
          <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            ALLOCATION
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
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }
}

export default Allocation;
