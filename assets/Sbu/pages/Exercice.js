import axios from "axios";
import React, { Component, useState } from "react";

const ExerciceOuvr = () => {

  const annee = ""
  const [exercs, setExercs] = useState({
    AnneeExercice: "",
    ordonateurExercice: "",
    description: "",
    nomenclature: ""
  });

  const [error, setError] = useState("");

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setExercs({...exercs, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
     await axios
      .post("http://localhost:8000/api/exercice_registres", exercs)
      .then(response => console.log(response));
    } catch(error) {
     setError("Informations incorrectes")
    }
   
  };

  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form onSubmit={handleSubmit}>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Année *</label>
                </div>
                <div className="col-sm-3">
                  <input
                    name="AnneeExercice"
                    type="number"
                    className={"form-control required" + (error && " is-invalid")}
                    data-v-max={2100}
                    data-v-min={0}
                    value={exercs.AnneeExercice}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">Nomenclature *</label>
                </div>
                <div className="col-sm-3">
                <input
                    name="nomenclature"
                    type="text"
                    className={"form-control required" + (error && " is-invalid")}
                    placeholder="2021"
                    value={exercs.nomenclature}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
              </div>
             
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Ordonnateur *</label>
                </div>
                <div className="col-sm-10">
                  <input
                    id="ordonateurExercice"
                    name="ordonateurExercice"
                    type="text"
                    className={"form-control required" + (error && " is-invalid")}
                    data-a-sign="MR. "
                    value={exercs.ordonateurExercice}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea 
                  id="description"
                  name="description"
                  type="text" 
                  className={"form-control required" + (error && " is-invalid")} 
                   value={exercs.description}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">
                  Créer
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

const ExerciceModif = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Type de modification *</label>
                </div>
                <div className="col-sm-3">
                  <select className=" form-control">
                    <option value="1">Decision modificative</option>
                    <option value="2">Supplementaire</option>
                  </select>
                  </div>
                  <div className="col-sm-2">
                  <label className="col-form-label">Nombre de modification</label>
                </div>
                  <div className="col-sm-2">
                    <input type="text" className="form-control" placeholder="1" />
                  </div>
                </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Date d'approbation *</label>
                </div>
                <div className="col-sm-3">
                  <input type="date" className="form-control" />
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Motif de modification *
                  </label>
                </div>
                <div className="col-sm-5">
                  <textarea type="text" className="form-control" />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">
                  Modifier
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

const ExerciceClotur = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Date de clôture</label>
                </div>
                <div className="col-sm-3">
                  <input type="date" className="form-control" />
                </div>
              </div>
              <div className="text-right col-sm-8">
                <button type="submit" className="btn btn-primary">
                  Clôturer
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

const ExerciceConsult = () => {
  return (
    <div className="page-body">
  <div className="card-block">
    <h5 className="card-header-text">Listes des Exercices</h5>
    <div className="table-responsive">
      <table>
        <thead>
          <tr>
            <th>Année</th>
            <th>Date d'ouverture</th>
            <th>Date de vote</th>
            <th>Date d'adoption</th>
            <th>Date de cloture</th>
            <th>Ordonnateur</th>
            <th>Description</th>
            <th>Status</th>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2019</td>
            <td>2019/04/25</td>
            <td>2019/04/25</td>
            <td>2019/04/25</td>
            <td>2019/04/25</td>
            <td>Lams</td>
            <td>xhxhxhxh</td>
            <td>Clôturer</td>
            <td>
              <a href="#!" className="m-r-45 text-muted" data-toggle="tooltip" data-placement="top" data-original-title="Modifier"><i className="icofont icofont-ui-edit" /></a>
            </td>
          </tr>
         </tbody>
      </table>
    </div>
  </div>

    </div>
  );
};

class Exercice extends Component {
  render() {
    return (
      <section id="exp">
        <div className="product-detail-page">
          <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            REGISTRE EXERCICE 
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
                href="#ouverture"
                role="tab"
              >
                Ouverture
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#modificatif"
                role="tab"
              >
                Modificatif
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#cloture"
                role="tab"
              >
                Clôture
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#consulter"
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
                <div className="tab-pane active" id="ouverture" role="tabpanel">
                  <ExerciceOuvr />
                </div>
                <div className="tab-pane" id="modificatif" role="tabpanel">
                  <ExerciceModif />
                </div>
                <div className="tab-pane" id="cloture" role="tabpanel">
                  <ExerciceClotur />
                </div>
                <div className="tab-pane" id="consulter" role="tabpanel">
                  <ExerciceConsult />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }
}

export default Exercice;
