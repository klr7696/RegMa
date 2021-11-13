import axios from "axios";
import React, { useEffect, useState } from "react";
import OuvriExerc from "../Exercice/OuvriExerc";

const InscriOuvert = () => {
  const [creds, setCreds] = useState({
    montantInscription: "",
    ressourceFinanciere: "",
    compteNature: "",
    descriptionInscription: "",
    bail: "",
  });

  const [error, setErrors] = useState("");

  const [bailleurs, setBailleurs] = useState([]);

  const fetchBailleurs = async () => {
    try {
      const data = await axios
        .get(
          "http://localhost:8000/api/bailleurs/actifressource?associationRessource.estValide=true"
        )
        .then((response) => response.data["hydra:member"]);
      setBailleurs(data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchBailleurs();
  }, []);

  const [finans, setFinans] = useState([]);

  const fetchFinans = async (id) => {
    try {
      const data = await axios
        .get(`http://localhost:8000/api/bailleurs/${id}/ressources`)
        .then((response) => response.data["hydra:member"]);
      setFinans(data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchFinans();
  }, []);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setCreds({ ...creds, [name]: value });
  };

  const [natures, setNatures] = useState([]);

  const fetchNatures = async () => {
    try {
      const data = await axios
        .get("http://localhost:8000/api/natures?hierachieCompteNature=Chapitre")
        .then((response) => response.data["hydra:member"]);
      setNatures(data);
      if (!creds.compteNature) setCreds({ ...creds, compteNature: data[0].id });
    } catch (error) {
      console.log(error.response);
    }
  };

  useEffect(() => {
    fetchNatures();
  }, []);

  const [sousnatures, setSousNatures] = useState([]);

  const fetchSousNatures = async (id) => {
    try {
      const data = await axios
        .get(`http://localhost:8000/api/natures/${id}/sousnatures`)
        .then((response) => response.data["hydra:member"]);
      setSousNatures(data);
      //if (!creds.compteNature) setCreds({ ...creds, compteNature: data[0].id });
    } catch (error) {
      console.log(error.response);
    }
  };

  useEffect(() => {
    fetchSousNatures();
  }, []);

  const handleSubmit = async (event) => {
    event.preventDefault();

    console.log(creds);

    try {
      const response = await axios.post(
        "http://localhost:8000/api/ouverts/inscription",
        {
          ...creds,
          ressourceFinanciere: `/api/ressources/${creds.ressourceFinanciere}`,
          compteNature: `/api/natures/${creds.compteNature}`,
        }
      );
      console.log(response.data);
    } catch (error) {
      console.log(error.response);
      setErrors("Erreur de Saisie");
    }
  };

  return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">Crédit ouvert</div>
            <OuvriExerc />
          </div>
        </h4>
        <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
          <li className="nav-item">
            <a
              className="nav-link active f-18 p-b-0"
              href="#/sbu/credit-ouvert/new"
            >
              Création
            </a>
            <div className="slide" />
          </li>

          <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" href="#/sbu/cred-ouver">
              Actualisation
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" href="#/sbu/credit-ouvert">
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
                  <form onSubmit={handleSubmit}>
                    <div className="card">
                      <div className="card-block">
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">Bailleur *</label>
                          </div>
                          <div className="col-sm-4">
                            <select
                              onChange={handleChange}
                              name="bail"
                              className="form-control"
                              value={creds.bail}
                              onClick={() => fetchFinans(creds.bail)}
                            >
                              {" "}
                              <option value={0}>Choisir le bailleur </option>
                              {bailleurs.map((bailleur) => (
                                <option key={bailleur.id} value={bailleur.id}>
                                  {bailleur.sigleBailleur}
                                </option>
                              ))}
                            </select>
                          </div>

                          <div className="col-sm-2">
                            <label className="col-form-label">Objet *</label>
                          </div>
                          <div className="col-sm-4">
                            <select
                              id="ressourceFinanciere"
                              onChange={handleChange}
                              name="ressourceFinanciere"
                              className="form-control"
                              value={creds.ressourceFinanciere}
                            >
                              {finans.map((finan) => (
                                <option key={finan.id} value={finan.id}>
                                  {finan.objetFinancement}
                                </option>
                              ))}
                            </select>
                          </div>
                        </div>
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">
                              Montant (FCFA)
                            </label>
                          </div>
                          <div className="col-sm-4">
                            <select
                              onChange={handleChange}
                              name="ressourceFinanciere"
                              value={creds.ressourceFinanciere}
                              className="form-control"
                            >
                              {finans.map((finan) => (
                                <option key={finan.id} value={finan.id}>
                                  {finan.montantFinancement}
                                </option>
                              ))}
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="card">
                      <div className="card-block">
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">Chapitre </label>
                          </div>
                          <div className="col-sm-2">
                            <select
                              onChange={handleChange}
                              name="compteNature"
                              value={creds.compteNature}
                              className="form-control"
                              onClick={() => fetchSousNatures(creds.compteNature)}
                            >
                              {natures.map((nature) => (
                                <option key={nature.id} value={nature.id}>
                                  {nature.numeroCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>

                          <div className="col-sm-2">
                            <label className="col-form-label">Article </label>
                          </div>
                          <div className="col-sm-2">
                            <select
                              name="compteNature"
                              className="form-control"
                              value={creds.compteNature}
                            >
                              {sousnatures.map((sousnature) => (
                                <option key={sousnature.id} value={sousnature.id}>
                                  {sousnature.numeroCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>
                         {/* <div className="col-sm-2">
                            <label className="col-form-label">
                              Paragraphe{" "}
                            </label>
                          </div>
                          <div className="col-sm-2">
                            <select
                              name="compteNature"
                              className="form-control"
                              value={creds.compteNature}
                            >
                              {natures.map((nature) => (
                                <option key={nature.id} value={nature.id}>
                                  {nature.sectionCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>*/}
                        </div>
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">
                              Numéro du compte choisit{" "}
                            </label>
                          </div>
                          <div className="col-sm-2">
                            <select
                              onChange={handleChange}
                              name="compteNature"
                              value={creds.compteNature}
                              className="form-control"
                            >
                              {natures.map((nature) => (
                                <option key={nature.id} value={nature.id}>
                                  {nature.numeroCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>

                          <div className="col-sm-2">
                            <label className="col-form-label">Section </label>
                          </div>
                          <div className="col-sm-6">
                            <select
                              disabled="disabled"
                              name="compteNature"
                              className="form-control"
                              value={creds.compteNature}
                            >
                              {natures.map((nature) => (
                                <option key={nature.id} value={nature.id}>
                                  {nature.sectionCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>
                        </div>
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">Libellé </label>
                          </div>
                          <div className="col-sm-10">
                            <select
                              disabled="disabled"
                              name="compteNature"
                              className="form-control"
                              value={creds.compteNature}
                            >
                              {natures.map((nature) => (
                                <option key={nature.id} value={nature.id}>
                                  {nature.libelleCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>
                        </div>
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">
                              Montant * (FCFA)
                            </label>
                          </div>
                          <div className="col-sm-4">
                            <input
                              id="space"
                              type="text"
                              name="montantInscription"
                              value={creds.montantInscription}
                              onChange={handleChange}
                              data-a-dec="."
                              data-a-sep=" "
                              className={
                                "currency form-control" +
                                (error && " is-invalid")
                              }
                            />
                          </div>
                        </div>
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">
                              Description
                            </label>
                          </div>
                          <div className="col-sm-10">
                            <textarea
                              onChange={handleChange}
                              name="descriptionInscription"
                              id="descriptionInscription"
                              value={creds.descriptionInscription}
                              type="text"
                              className="form-control"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="text-right col-sm-12">
                      <button type="submit" className="btn btn-primary">
                        Enregistrer
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default InscriOuvert;
