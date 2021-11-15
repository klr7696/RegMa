import axios from "axios";
import React, { useEffect, useState } from "react";
import { toast } from "react-toastify";
import OuvriExerc from "../../../Sbu/pages/Exercice/OuvriExerc";

const InscriClasse = () => {

  const [paras, setParas] = useState({
    numeroCompteNature: "",
    libelleCompteNature: "",
    hierachieCompteNature: "Paragraphe",
    descriptionCompteNature: "",
    compteNature: "",
  });

  const [error, setErrors] = useState("");
  const [compteNatures, setCompteNatures] = useState([]);
  const [nomenclatures, setNomens] = useState([]);

  const fetchCompteNatures = async () => {
    try {
      const data = await axios
        .get("http://localhost:8000/api/natures?hierachieCompteNature=Article")
        .then((response) => response.data["hydra:member"]);
      setCompteNatures(data);
      if (!paras.compteNature) setParas({...paras, compteNature:data[0].id} )
    } catch (error) {
      console.log(error.response);
    }
  };

  useEffect(() => {
    fetchCompteNatures();
  }, []);

  const fetchNomen = async () => {
    try {
      const data = await axios
        .get("http://localhost:8000/api/nomenclatures?estActif=true")
        .then((response) => response.data["hydra:member"]);
      setNomens(data);
    } catch (error) {
      console.log(error.response);
    }
  };

  useEffect(() => {
    fetchNomen();
  }, []);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setParas({ ...paras, [name]: value });
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    try {
      const response = await axios.post(
        "http://localhost:8000/api/natures/sousnatures",
        { ...paras, compteNature: `/api/natures/${paras.compteNature}`}
      );
      console.log(response.data);
      toast.success(`Paragraphe ${paras.numeroCompteNature} Ajoutée`)
    } catch (error) {
      console.log(error.response);
      setErrors("Erreur de Saisie");
      toast.error("Paragraphe Non Ajouté");
    }
  };

  return (
    <section id="exp">
      <div className="product-detail-page">
            <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
              Classe
            </div>
            <OuvriExerc/>
            </div>
          </h4>
        <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
          <li className="nav-item">
            <a className="nav-link f-18 p-b-0" href="#/sbu/chap/new">
              Chapitre
            </a>
            <div className="slide" />
          </li>

          <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" href="#/sbu/arti/new">
              Article
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item m-b-0">
            <a className="nav-link active f-18 p-b-0" href="#/sbu/para/new">
              Paragraphe
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" href="#/sbu/compte-nature">
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
          </div>
        </div>
      </div>
    </section>
  );
};

export default InscriClasse;
