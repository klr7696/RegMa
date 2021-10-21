import axios from "axios";
import React, { Component, useEffect, useState } from "react";

const CreatChap = () => {


  const [chaps, setChaps] = useState({
    numeroCompteNature: 61,
    libelleCompteNature : "libelle3",
    sectionCompteNature: "",
    hierachieCompteNature: "Chapitre",
    descriptionCompteNature: "cfehfcjfjk",
    nomenclature:""
  });

  const [error, setErrors] = useState("");
  const [nomens, setNomens] = useState([]);

  const fetchNomen = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/nomenclatures")
  .then(response => response.data["hydra:member"]);
    setNomens(data);
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
      fetchNomen();
  }, []);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setChaps({...chaps, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      const response = await axios
      .post("http://localhost:8000/api/natures/chapitres", {...chaps,
    nomenclature:`/api/nomenclatures/${chaps.nomenclature}`});
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
               <div className="col-sm-2">
                  <label className="col-form-label">Section *</label>
                </div>
                  <div className="col-sm-3">
                  <select 
                  onChange={handleChange} 
                  name="sectionCompteNature"
                  id="sectionCompteNature"
                  value={chaps.sectionCompteNature}
                  className={"form-control" + (error && " is-invalid")}
                 >
                    <option value="1">Fonctionnement</option>
                    <option value="2">Investissement</option>
                  </select>
                  </div>
              </div>
              <div className="row form-group">
              <div className="col-sm-2">
                  <label className="col-form-label">Nomenclature *</label>
                </div>
                  <div className="col-sm-3">
                  <select 
                  onChange={handleChange} 
                  name="nomenclature"
                  id="nomenclature"
                  value={chaps.nomenclature}
                  className={"form-control" + (error && " is-invalid")}
                 >
                   {nomens.map(nomen => <option key={nomen.id} value={nomen.id}>
                     {nomen.anneeApplication}
                   </option>)}
                    </select>
                  </div>
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

  const [arts, setArts] = useState({
    numeroCompteNature: 601,
    libelleCompteNature : "libelle3",
    hierachieCompteNature: "Article",
    descriptionCompteNature: "cfehfcjfjk",
    compteNature:""
  });

  const [error, setErrors] = useState("");
  const [compteNatures, setCompteNatures] = useState([]);

  const fetchCompteNatures = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/natures?hierachieCompteNature=Chapitre")
  .then(response => response.data["hydra:member"]);
    setCompteNatures(data);
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
      fetchCompteNatures();
  }, []);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setArts({...compteNatures, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      const response = await axios
      .post("http://localhost:8000/api/natures/sousnatures", {...arts,
    compteNature:`/api/natures/${arts.compteNature}`});
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
                    type="text"
                    className="form-control autonumber"
                    placeholder="***"
                    data-v-max={999}
                    data-v-min={0}
                    className={"form-control required" + (error && " is-invalid")}
                    value={arts.numeroCompteNature}
                    onChange={handleChange}
                  />
                </div>
             
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro du Chapitre *
                  </label>
                </div>
                <div className="col-sm-3">
                  <select 
                  onChange={handleChange} 
                  name="compteNature"
                  id="compteNature"
                  value={arts.compteNature}
                  className={"form-control" + (error && " is-invalid")}
                 >
                   {compteNatures.map(compteNature => <option key={compteNature.id} value={compteNature.id}>
                     {compteNature.numeroCompteNature}
                   </option>)}
                    </select>
                  </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Libellé *</label>
                </div>
                <div className="col-sm-10">
                  <input type="text" className="form-control" 
                   className={"form-control required" + (error && " is-invalid")}
                   value={arts.libelleCompteNature}
                   onChange={handleChange}
                  />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea type="text" className="form-control" 
                   className={"form-control required" + (error && " is-invalid")}
                    value={arts.descriptionCompteNature}
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

const CreatParag = () => {
  
  const [paras, setParas] = useState({
    numeroCompteNature: 601,
    libelleCompteNature : "libelle3",
    hierachieCompteNature: "Article",
    descriptionCompteNature: "cfehfcjfjk",
    compteNature:""
  });

  const [error, setErrors] = useState("");
  const [compteNatures, setCompteNatures] = useState([]);

  const fetchCompteNatures = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/natures?hierachieCompteNature=Article")
  .then(response => response.data["hydra:member"]);
    setCompteNatures(data);
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
      fetchCompteNatures();
  }, []);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setParas({...compteNatures, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      const response = await axios
      .post("http://localhost:8000/api/natures/sousnatures", {...paras,
    compteNature:`/api/natures/${paras.compteNature}`});
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

  const [chaps, setChaps] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/natures")
      .then(response => response.data["hydra:member"])
      .then(data => setChaps(data));
  }, []);

  return (
    <div className="page-body">
          <div className="card-block">
          <h5 className="card-header-text">Liste de Comptes</h5>
      <div className="table-responsive dt-responsive">
        <table
          id="lang-file"
          className="table table-striped table-bordered nowrap"
        >
      <thead>
                  <tr>
                    <th>Num</th>
                    <th>Libéllé</th>
                    <th>Section</th>
                    <th>Hierar</th>
                    <th>Nomen</th>
                  </tr>
                  </thead>
                  <tbody>
                  {chaps.map(chap =>
                        <tr key={chap.id}>
                          <td>{chap.numeroCompteNature}</td>
                        <td>{chap.libelleCompteNature}</td>
                        <td>{chap.sectionCompteNature}</td>
                        <td>{chap.hierachieCompteNature}</td>
                        <td>{chap.nomenclature}</td>
                       
              </tr>)}
                   
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
