import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { toast } from 'react-toastify';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const InscriProjet = (props) => {
 
  const { id = "new" } = props.match.params;

  const [projet, setProjet] = useState({
    objetMarche: "",
    montantProjet: "",
    numeroProjet: "",
    referenceProjet: "",
    prioriteProjet: "",
    specificiteProjet: "",
    pieceFournir: "",
    prixDossier: "",
    propositionMinimum: "",
    modePassation: "",
  });

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setProjet({...projet, [name]: value });
  };

  const [modes, setModes] = useState([]);

  const fetchModes = async () => {
    try {
      const data = await axios
        .get("http://localhost:8000/api/modes")
        .then((response) => response.data["hydra:member"]);
      setModes(data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchModes();
  }, []);
 
  const handleSubmit = async event => {
    event.preventDefault();
    
     try {
      const response = await axios
      .post("http://localhost:8000/api/projets", {...projet,
    modePassation: `/api/modes/${projet.modePassation}`
    });
    toast.success("Projet de marché créé")
      console.log(response.data);
  } catch(error) {
   console.log(error)
   setError("Informations incorrectes")
  }
}; 

    return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">
           Projet de marché
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/scp/projet-marche/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/scp/projet-marche"
              >
                Consultation
              </a>
              <div className="slide" />
            </li>
          </ul>
          <div className="card">
        <div className="card-block">
          <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
        <div className="card-block">
        <form onSubmit={handleSubmit}>
        <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Numéro</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="numeroProjet"
                      value={projet.numeroProjet}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Objet</label>
                  </div>
                  <div className="col-sm-4">
                  <select 
                  name="objetMarche"
                  className="form-control"
                  value= {projet.objetMarche}
                  onChange={handleChange}
                  >
                    <option value="Fonctionnement">Fonctionnement</option>
                    <option value="Investissement">Investissement</option>
                  </select>
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Montant</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      onChange={handleChange}
                      name="montantProjet"
                      value={projet.montantProjet}
                      class="form-control autonumber" data-a-sep=" " data-a-dec=","
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Réference</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="referenceProjet"
                      value={projet.referenceProjet}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Priorité</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="prioriteProjet"
                      value={projet.prioriteProjet}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Specificité</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="specificiteProjet"
                      value={projet.specificiteProjet}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Prix dossier</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      onChange={handleChange}
                      name="prixDossier"
                      value={projet.prixDossier}
                      class="form-control autonumber" data-a-sep=" " data-a-dec=","
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Proposition minimum</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="propositionMinimum"
                      value={projet.propositionMinimum}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Pièce fournies </label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="pieceFournir"
                      value={projet.pieceFournir}
                    />
                  </div>
                <div className="col-sm-2">
                    <label className="col-form-label">Mode de passation</label>
                  </div>
                  <div className="col-sm-4">
                  <select
                              name="modePassation"
                              className="form-control"
                              value={projet.modePassation}
                              onChange={handleChange}
                            > <option value=""> Choisir... </option>
                              {modes.map((mode) => (
                                <option key={mode.id} value={mode.id}>
                                  {mode.abbreviationMode}
                                </option>
                              ))}
                            </select>
                  </div>
               
                </div>
                <div className="text-right col-sm-12">
                  <button type="submit" className="btn btn-primary">Créer</button>
                </div>
              </form>
    
   </div>
        </div>
      </div>
    </div>
        </div>
      </div>
          </div>
      </section>
    );
};

export default InscriProjet;