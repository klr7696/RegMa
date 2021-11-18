import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { toast } from 'react-toastify';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const InscriPlan = ({match, history}) => {
 
  const { id = "new" } = match.params;

  const [plans, setPlans] = useState({
    presidentCommission: "",
    ordonnateurPlan: "",
    AdresseDepouillement: "",
    descriptionPlan: "",
    mairieCommunale: "",
    exerciceRegistre: "",
    adresseDepouillement: ""
  });

  const [mairies, setMairies] = useState([]);
    
  const fetchMairies = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/mairies")
  .then(response => response.data["hydra:member"]);
    setMairies(data);
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
    fetchMairies();
}, []);

const [status, setStatus] = useState([]);

const fetchStatus = async () => {
  try{
const data = await axios
.get("http://localhost:8000/api/registats/registre_ouvert")
.then(response => response.data["hydra:member"]);
setStatus(data)
if (!finans.statutRegistre, !finans.exerciceRegistre) setFinans({...finans, 
  exerciceRegistre:data[0].exerciceRegistre.id, statutRegistre:data[0].id})
  } catch (error) {
  console.log(error);
  }
};

useEffect(() =>{
    fetchStatus();
}, []);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setPlans({...plans, [name]: value });
  };
 
  const handleSubmit = async event => {
    event.preventDefault();
    
     try {
      const response = await axios
      .post("http://localhost:8000/api/plans", {...plans,
      mairieCommunale:`/api/mairies/${plans.mairieCommunale}`,
      exerciceRegistre:`/api/registres/${plans.exerciceRegistre}`,
    } );
      console.log(response.data);
      toast.success("Plan créé avec succès")
      history.replace("/scp/plan")
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
           Plan de passation
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/scp/plan/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/scp/plan"
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
                    <label className="col-form-label">Président Commission</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      name="presidentCommission"
                      className="form-control"
                      onChange={handleChange}
                      value={plans.presidentCommission}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Ordonnateur</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                    name="ordonnateurPlan"
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      value={plans.ordonnateurPlan}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Adresse de depouillement</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      name="adresseDepouillement"
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      value={plans.adresseDepouillement}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Mairie communale</label>
                  </div>
                  <div className="col-sm-4">
                  <select 
                  onChange={handleChange} 
                  name="mairieCommunale"
                  value={plans.mairieCommunale}
                  className="form-control"
                 ><option value="">...</option>
                   {mairies.map(mairie => <option key={mairie.id} value={mairie.id}>
                       {mairie.abbreviationMairie} 
                     </option>)}
                   </select>
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Exercice</label>
                  </div>
                  <div className="col-sm-4">
                  <select 
                  onChange={handleChange} 
                  name="exerciceRegistre"
                  value={plans.exerciceRegistre}
                  className="form-control"
                 ><option value="">...</option>
                   {status.map(status => <option key={status.id} value={status.id}>
                       {status.exerciceRegistre.anneeExercice} 
                     </option>)}
                   </select>
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Adresse depouillement</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                    name="AdresseDepouillement"
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      value={plans.AdresseDepouillement}
                    />
                  </div>
                </div>
                <div className="row form-group">
                  <div className="col-sm-2">
                    <label className="col-form-label">Description</label>
                  </div>
                  <div className="col-sm-10">
                    <textarea
                    name="descriptionPlan"
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      value={plans.descriptionPlan}
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

export default InscriPlan;