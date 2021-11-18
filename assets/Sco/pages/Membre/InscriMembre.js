import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { toast } from 'react-toastify';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const InscriMembre = (props) => {
 
  const { id = "new" } = props.match.params;

  const [membres, setMembres] = useState({
    matricule: "",
    nomMembre: "",
    serviceMembre: "",
    fonctionService: "",
    contact: ""
  });

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setMembres({...membres, [name]: value });
  };
 
  const handleSubmit = async event => {
    event.preventDefault();
    
     try {
      const response = await axios
      .post("http://localhost:8000/api/membres", membres );
      toast.success("Participant inscrit avec succès")
      console.log(response.data);
  } catch(error) {
   console.log(error.response)
   setErrors("Informations incorrectes")
  }
}; 

    return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">
            Membre
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/sco/membre/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/sco/membre"
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
                    <label className="col-form-label">Matricule</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="matricule"
                      value={membres.matricule}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Nom et Prenoms</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="nomMembre"
                      value={membres.nomMembre}
                    />
                  </div>
                </div>
              
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Service</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="serviceMembre"
                      value={membres.serviceMembre}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Fonction service</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="fonctionService"
                      value={membres.fonctionService}
                    />
                  </div>
                </div>
                <div className="row form-group">
                  <div className="col-sm-2">
                    <label className="col-form-label">Contact</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      data-mask="(999) 9999-9999"
                      className="form-control phone"
                      onChange={handleChange}
                      name="contact"
                      value={membres.contact}
                    />
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

export default InscriMembre;