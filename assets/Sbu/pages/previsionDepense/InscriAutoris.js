import axios from 'axios';
import React, { useEffect, useState } from 'react';
import autoriseAPI from '../../../zservices/autoriseAPI';
import OuvriExerc from '../Exercice/OuvriExerc';

const InscriAutoris = () => {

    const [autorises, setAutorises] = useState({
      objetAutorisation: "Fonctionnement",
      montantAutorisation: 100000000,
      explicationAutorisation: "tout tout",
      mairieCommunale: "",
      compteNature: "",
      associationStatut: "",
      });

  const [arts, setArts] = useState([]);

  const fetchArts = async (id) => {
    try {
      const data = await axios
        .get(`http://localhost:8000/api/natures/${id}/sousnatures?hierachieCompteNature=Article`)
        .then((response) => response.data["hydra:member"]);
      setArts(data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchArts();
  }, []);

  const [paras, setParas] = useState([]);

  const fetchParas = async (id) => {
    try {
      const data = await axios
        .get(`http://localhost:8000/api/natures/${id}/sousnatures?hierachieCompteNature=Paragraphe`)
        .then((response) => response.data["hydra:member"]);
      setParas(data);
      //if (!autorises.compteNature) setautorises({ ...autorises, compteNature: data[0].id });
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchParas();
  }, []);

 
      const [error, setErrors] = useState("");

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
    
      const handleChange = ({ currentTarget }) => {
        const { name, value } = currentTarget;
        setAutorises({...autorises, [name]: value });
      };

      const [status, setStatus] = useState([]);

      const fetchStatus = async () => {
        try{
      const data = await axios
      .get("http://localhost:8000/api/registats/registre_ouvert")
      .then(response => response.data["hydra:member"]);
      setStatus(data)
      if (!autorises.associationStatut) setAutorises({...autorises, associationStatut:data[0].id})
        } catch (error) {
        console.log(error);
        }
      };
    

  useEffect(() =>{
      fetchStatus();
  }, []);

    const [natures, setNatures] = useState([]);

    const fetchNatures = async () => {
      try{
    const data = await axios
    .get("http://localhost:8000/api/natures?hierachieCompteNature=Chapitre")
    .then(response => response.data["hydra:member"]);
      setNatures(data);
     if (!autorises.compteNature) setAutorises({...autorises, compteNature:data[0].id} )
      } catch (error) {
      console.log(error.response);
      }
    };

    useEffect(() => {
      fetchNatures();
    }, []);

      const handleSubmit = async event => {
        event.preventDefault();
        console.log(autorises)
    
       try {
         await autoriseAPI.create({...autorises,
          mairieCommunale:`/api/mairies/${autorises.mairieCommunale}`,
          compteNature:`/api/natures/${autorises.compteNature}`,
          associationStatut:`/api/registats/${autorises.associationStatut}`
        }),
          
          console.log(response.data);
        } catch(error) {
          console.log(error.response);
          setErrors("Erreur de Saisie")
        }
      };

    return (
        <section id="exp">
        <div className="product-detail-page">
        <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
            Crédit autorisé
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/credit-autorise/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-autorise"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-autorise"
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
                <form onSubmit={handleSubmit} >
                <div className="card-block">
                <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">Chapitre </label>
                          </div>
                          <div className="col-sm-2">
                            <select
                              name="compteNature"
                              className="form-control"
                              value={autorises.compteNature}
                              onChange={handleChange}
                              onClick={() => fetchArts(autorises.compteNature)}
                              //onClick={() => fetchLibelles(autorises.compteNature)}
                            > <option value={0}> Choisir... </option>
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
                              value={autorises.compteNature}
                              onChange={handleChange}
                             onClick={() => fetchParas(autorises.compteNature)}
                            >  <option value={0}> Choisir... </option>
                              {arts.map((arti) => (
                                <option key={arti.id} value={arti.id}>
                                  {arti.numeroCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>

                          <div className="col-sm-2">
                            <label className="col-form-label">
                              Paragraphe
                            </label>
                          </div>
                          <div className="col-sm-2">
                            <select
                              name="compteNature"
                              className="form-control"
                              value={autorises.compteNature}
                              onChange={handleChange}
                            >  <option value={0}> Choisir... </option>
                              {paras.map((para) => (
                                <option key={para.id} value={para.id}>
                                  {para.numeroCompteNature}
                                </option>
                              ))}
                            </select>
                          </div>
                        </div>
                        <div className="row form-group">
                          <div className="col-sm-2">
                            <label className="col-form-label">Section </label>
                          </div>
                          <div className="col-sm-6">
                            <select
                              disabled="disabled"
                              name="compteNature"
                              className="form-control form-control-bold"
                              value={autorises.compteNature}
                            > <option value={0}>... </option>
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
                              className="form-control form-control-bold"
                              value={autorises.compteNature}
                              onChange={handleChange}
                             // onClick={() => fetchArts(autorises.compteNature)}
                              //onClick={() => fetchLibelles(autorises.compteNature)}
                            > <option value={0}>... </option>
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
                   <label className="col-form-label">Mairie communale</label>
                  </div>
                    <div className="col-sm-4">
                 <select 
                  onChange={handleChange} 
                  name="mairieCommunale"
                  value={autorises.mairieCommunale}
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
                  <label className="col-form-label">Objet de l'autorisation </label>
                </div>
                <div className="col-sm-4">
                 <select 
                  onChange={handleChange} 
                  name="objetAutorisation"
                  id="objetAutorisation"
                  value={autorises.objetAutorisation}
                  className="form-control"
                 >
                   <option value="Fonctionnement">Fonctionnement</option>
                    <option value="Investissement">Investissement</option>
                    </select>
                   </div>

                  <div className="col-sm-2">
                   <label className="col-form-label">Montant de l'autorisation</label>
                  </div>
                    <div className="col-sm-4">
                 <input 
                  onChange={handleChange} 
                  name="montantAutorisation"
                  type="number"
                  value={autorises.montantAutorisation}
                  className="form-control"
                 />
                   </div>
                    
                  </div>
                <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label"> Explication de l'autorisation </label>
                </div>
                <div className="col-sm-10">
                  <textarea
                    onChange={handleChange} 
                    name="explicationAutorisation"
                    id="explicationAutorisation"
                    value={autorises.explicationAutorisation}
                    type="text"
                    className="form-control"
                  />
                </div>
                </div>
                  <div className="text-right col-sm-12">
                    <button type="submit" className="btn btn-primary">Enregistrer</button>
                  </div>
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

export default InscriAutoris;