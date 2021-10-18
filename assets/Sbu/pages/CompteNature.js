import axios from "axios";
import React, { Component, useEffect, useState } from "react";

const CreatChap = () => {


  const [chaps, setChaps] = useState({
    numeroCompteNature: 600,
    libelleCompteNature : "libelle",
    sectionCompteNature: "section",
    hierachieCompteNature: "Fonction",
    descriptionCompteNature: "cfehfcjfjk",
    compteNature:""
  });

  const [error, setErrors] = useState("");


  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setChaps({...chaps, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      const response = await axios
      .post("http://localhost:8000/api/natures", {...chaps,
    compteNature:`/api/natures/${chaps.compteNature}`});
      console.log(response.data);
    } catch(error) {
      console.log(error.response);
      setErrors("Erreur de Saisie")
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
                  <label className="col-form-label">
                    Numéro *
                  </label>
                </div>
                <div className="col-sm-2">
                  <input
                  name="numeroCompteNature"
                    type="number"
                    className="form-control"
                    placeholder="**"
                    data-v-max={99}
                    data-v-min={0}
                    className={"form-control required" + (error && " is-invalid")}
                  value={chaps.numeroCompteNature}
                  onChange={handleChange}
                  />
                </div>
               {/* <div className="col-sm-2">
                  <label className="col-form-label">Section *</label>
                </div>
                  <div className="col-sm-3">
                  <select className="form-control ">
                    <option selected="">...</option>
                    <option value="1">Fonctionnement</option>
                    <option value="2">Investissement</option>
                  </select>
  </div>*/}
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Libellé *</label>
                </div>
                <div className="col-sm-10">
                  <input 
                  name="libelleCompteNature"
                  type="text"
                   className={"form-control " + (error && " is-invalid")}
                  value={chaps.libelleCompteNature}
                  onChange={handleChange}
                  />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Compte Nature *</label>
                </div>
                <div className="col-sm-10">
                  <input 
                  name="compteNature"
                  type="text"
                   className={"form-control " + (error && " is-invalid")}
                  value={chaps.compteNature}
                  onChange={handleChange}
                  />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea 
                  name="descriptionCompteNature"
                  type="text" 
                   className={"form-control" + (error && " is-invalid")}
                  value={chaps.descriptionCompteNature}
                  onChange={handleChange}
                  />
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

const CreatArt = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro *
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
                    Numéro du Chapitre *
                  </label>
                </div>
                <div className="col-sm-3">
                  <select className="form-control ">
                    <option selected="">...</option>
                    <option value="1">60</option>
                    <option value="2">61</option>
                  </select>
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

const CreatParag = () => {
  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro *
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
                    Numéro d'article *
                  </label>
                </div>
                <div className="col-sm-3">
                  <select className="form-control ">
                    <option selected="">...</option>
                    <option value="1">600</option>
                    <option value="2">610</option>
                  </select>
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

class CompteNature extends Component {
  render() {
    return (
      <section id="exp">
        <div className="product-detail-page">
        <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            NOMENCLATURE / COMPTES DE NATURE 
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
                href="#chapitre"
                role="tab"
              >
                Chapitre
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#article"
                role="tab"
              >
                Article
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#paragraphe"
                role="tab"
              >
                Paragraphe
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
                <div className="tab-pane active" id="chapitre" role="tabpanel">
                  <CreatChap />
                </div>
                <div className="tab-pane" id="article" role="tabpanel">
                  <CreatArt />
                </div>
                <div className="tab-pane" id="paragraphe" role="tabpanel">
                  <CreatParag />
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

export default CompteNature;
