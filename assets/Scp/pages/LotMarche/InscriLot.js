import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { toast } from 'react-toastify';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const InscriLot = (props) => {
 
  const { id = "new" } = props.match.params;

  const [lots, setLots] = useState({
  numeroLot: "",
  objetLot: "",
  montantLot: "",
  observationLot: "",
  delaiExecution: "",
  planPassation: "",
  autorisationMarche: "",
  projetMarche: ""
  });

  const [errors, setErrors] = useState([]);
  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setLots({...lots, [name]: value });
  };

const [plans, setPlans] = useState([]);

const fetchPlans = async () => {
  try{
const data = await axios
.get("http://localhost:8000/api/plans")
.then(response => response.data["hydra:member"]);
setPlans(data)
  } catch (error) {
  console.log(error);
  }
};

useEffect(() =>{
    fetchPlans();
}, []);

const [projets, setProjets] = useState([]);

const fetchProjets = async () => {
  try{
const data = await axios
.get("http://localhost:8000/api/projets")
.then(response => response.data["hydra:member"]);
setProjets(data);
  } catch (error) {
  console.log(error);
  }
};

useEffect(() =>{
    fetchProjets();
}, []);

const [autorisations, setAutorisations] = useState([]);

const fetchAutorisations = async () => {
  try{
const data = await axios
.get("http://localhost:8000/api/autorisations")
.then(response => response.data["hydra:member"]);
setAutorisations(data)
  } catch (error) {
  console.log(error);
  }
};

useEffect(() =>{
    fetchAutorisations();
}, []);

 
  const handleSubmit = async event => {
    event.preventDefault();
    
     try {
      const response = await axios
      .post("http://localhost:8000/api/lots", {...lots,
    planPassation: `/api/plans/${lots.planPassation}`,
    projetMarche: `/api/projets/${lots.projetMarche}`,
    autorisationMarche: `/api/autorisations/${lots.autorisationMarche}`
    } );
      console.log(response.data);
      toast.success("lot de marché créé")
  } catch(error) {
   console.log(error)
   setErrors("Informations incorrectes")
   toast.error("Erreur de création")
  }
}; 

    return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">
           Lot de marché
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/scp/lot-marche/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/scp/lot-marche"
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
        <div className="row">
                                                 <div className="col-md-4 col-lg-4">
  <div className="card card-block user-card pre-scrollable">
  <table className="table table-framed">
                        <thead>
           <tr>
             <th>Compte</th>
             <th>Montant autorisé </th>
           </tr>
         </thead>
        <tbody>
           {
             autorisations.map(
               autorisation => 
                        <tr id={autorisation.id} value={autorisation.id}>
                        <td>{autorisation.id}</td>
                        <td>{autorisation.montantAutorisation.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</td>
              </tr>
             )
           }
            </tbody>
       </table>
  </div>
</div>

    <div className="col-md-8">
        <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Numéro</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="number"
                      className="form-control"
                      onChange={handleChange}
                      name="numeroLot"
                      value={lots.numeroLot}
                    />
                  </div>
                </div>
                <div className="row form-group">
                  <div className="col-sm-2">
                    <label className="col-form-label">Objet</label>
                  </div>
                  <div className="col-sm-10">
                    <textarea
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="objetLot"
                      value={lots.objetLot}
                    />
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
                      name="montantLot"
                      value={lots.montantLot}
                      className="form-control autonumber" data-a-sep=" " data-a-dec=","
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Observation</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="observationLot"
                      value={lots.observationLot}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">delai d'execution (j)</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="delaiExecution"
                      value={lots.delaiExecution}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Plan de passation</label>
                  </div>
                  <div className="col-sm-4">
                  <select 
                  onChange={handleChange} 
                  name="planPassation"
                  value={lots.planPassation}
                  className="form-control"
                 ><option value="">...</option>
                   {plans.map(plan => <option key={plan.id} value={plan.id}>
                      Plan {plan.id} 
                     </option>)}
                   </select>
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Autorisation</label>
                  </div>
                  <div className="col-sm-4">
                 <select 
                  onChange={handleChange} 
                  name="autorisationMarche"
                  value={lots.autorisationMarche}
                  className="form-control"
                 ><option value="">...</option>
                   {autorisations.map(autorisation => <option key={autorisation.id} value={autorisation.id}>
                      Autorisation {autorisation.id}
                     </option>)}
                   </select>
                  </div>
                <div className="col-sm-2">
                    <label className="col-form-label">Projet de marché</label>
                  </div>
                  <div className="col-sm-4">
                  <select 
                  onChange={handleChange} 
                  name="projetMarche"
                  value={lots.projetMarche}
                  className="form-control"
                 ><option value="">...</option>
                   {projets.map(projet => <option key={projet.id} value={projet.id}>
                      Projet {projet.id} 
                     </option>)}
                   </select>
                  </div>
                </div>
                <div className="text-right col-sm-12">
                  <button type="submit" className="btn btn-primary">Créer</button>
                </div>
                </div>
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

export default InscriLot;