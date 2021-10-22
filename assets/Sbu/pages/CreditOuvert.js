import React, { Component } from "react";

const InscriCredit = () => {
  return (
    <div className="page-body">
        <div className=" card">
       <div className=" card-block">
      <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Bailleur *</label>
              </div>
              <div className="col-sm-3">
                <select className="form-control">
                  <option value="1">Etat</option>
                  <option value="2">Commune</option>
                </select>
              </div>
              <div className="col-sm-1">
                <label className="col-form-label">Objet *</label>
              </div>
              <div className="col-sm-3">
                <select className="form-control">
                  <option value="1">Fonctionnement</option>
                  <option value="2">Investissement</option>
                </select>
              </div>
              <div className="col-sm-1">
                <label className="col-form-label">Exercice</label>
              </div>
              <div className="col-sm-2">
                <select className="form-control">
                  <option selected="">...</option>
                  <option value="1">Fonctionnement</option>
                  <option value="2">Investissement</option>
                </select>
              </div>
              <div className="form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Montant actuel (FCFA)</label>
              </div>
              <div className="col-sm-7">
                <input type="number" className="form-control" readonly=""/>
              </div>
              </div>
              </div>
              </div>
              </div>

               <div className="col-sm-2 form-group">
                <select className="form-control">
                  <option value="none">Choix chapitre</option>
                  <option value="field-1">60</option>
                  <option value="field-2">70</option>
                  <option value="field-3">80</option>
                </select>
                </div>
  <div className="col-sm-12 col-xl-8 m-b-30">
 <div className="card">
<form action="#">
  <div className="card-block table-border-style">
    <div className="table-responsive">
      <table className="table table-framed">
        <thead>
          <tr>
            <th>Sous-comptes</th>
            <th>Montant</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>601</td>
            <td> <div className="form-group">
                  <input type="text" className="form-control" />
                </div></td>
          </tr>
          <tr>
            <td>602</td>
            <td> <div className="form-group">
                  <input type="text" className="form-control" />
                </div></td>
          </tr>
          <tr>
            <td>603</td>
            <td> <div className="form-group">
                  <input type="text" className="form-control" />
                </div></td>
          </tr>
          <tr>
              <td></td>
              <td></td>
              <td><div className="text-right col-sm-8">
                <button type="submit" className="btn btn-primary">
                  Inscrire
                </button>
</div></td>
          </tr>
  
        </tbody>
      </table>
    </div>
  </div>
  </form>
</div>

</div>
</div>
  );
};

const ActualiCredit = () => {
  return (
    <div className="page-body">
      <div className="row">
             <div className="col-sm-12">
                <div className="card-block">
                <div className="col-sm-4 form-group">
                <select className="form-control ">
                  <option value="none">selectionner le financement...</option>
                  <option value="field-1">Bailleur 1| Mode 1</option>
                  <option value="field-2">Bailleur 2| Mode 2</option>
                </select>
              </div>
                <div className="col-sm-12 col-xl-3 m-b-30"> 
                <select className="form-control">
                  <option value="none">Choisir un chapitre</option>
                  <option value="field-1">60</option>
                  <option value="field-2">70</option>
                  <option value="field-3">80</option>
                </select>
                </div>
                
  <div className="col-sm-12 col-xl-8 m-b-30">
 <div className="card">
<form action="#">
  <div className="card-block table-border-style pre-scrollable">
    <div className="table-responsive">
      <table className="table table-framed">
        <thead>
          <tr>
            <th>Sous-comptes</th>
            <th>Montant</th>
            <th>Nouveau montant</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>601</td>
            <td>40 000 000</td>
            <td> <div className="form-group">
                  <input type="text" className="form-control" />
                </div></td>
          </tr>
          <tr>
            <td>602</td>
            <td>10 000 000</td>
            <td> <div className="form-group">
                  <input type="text" className="form-control" />
                </div></td>
          </tr>
          <tr>
            <td>603</td>
            <td>60 000 000</td>
            <td> <div className="form-group">
                  <input type="text" className="form-control" />
                </div></td>
          </tr>
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td><div className="text-right col-sm-8">
                <button type="submit" className="btn btn-primary">
                  Inscrire
                </button>
</div></td>
          </tr>
  
        </tbody>
      </table>
    </div>
  </div>
  </form>
</div>

</div>
</div>
        </div> 
      </div>
    </div>
  
  );
};


class CreditOuvert extends Component {
  render() {
    return (
      <section id="exp">
        <div class="product-detail-page">
          <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
              CREDIT OUVERT
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
                  <InscriCredit />
                </div>
                <div className="tab-pane" id="actualisation" role="tabpanel">
                  <ActualiCredit />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }
}

export default CreditOuvert;
