import axios from 'axios';
import React, { useEffect, useState } from 'react';
import AllocAPI from '../../../zservices/allocAPI';
import OuvriExerc from '../Exercice/OuvriExerc';

const InscriAlloc = () => {

    const [allocs, setAllocs] = useState({
      montantAllouer: 1000000,
      descriptionAllocation: "OKKKKK",
      creditOuvert: "/api/ouverts/14",
      mairieCommunale: "/api/mairies/1",
      });
    
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

      const [natures, setNatures] = useState([]);

    const fetchNatures = async () => {
      try{
    const data = await axios
    .get("http://localhost:8000/api/natures")
    .then(response => response.data["hydra:member"]);
      setNatures(data);
     if (!allocs.compteNature) setAllocs({...allocs, compteNature:data[0].id} )
      } catch (error) {
      console.log(error.response);
      }
    };
      useEffect(() => {
        fetchNatures();
      }, []);
    
      const [arts, setArts] = useState([]);

  const fetchArts = async (id) => {
    try {
      const data = await axios
        .get(`http://localhost:8000/api/natures/${id}/sousnatures`)
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
        .get(`http://localhost:8000/api/natures/${id}/sousnatures`)
        .then((response) => response.data["hydra:member"]);
      setParas(data);
      //if (!creds.compteNature) setCreds({ ...creds, compteNature: data[0].id });
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchParas();
  }, []);

      const handleChange = ({ currentTarget }) => {
        const { name, value } = currentTarget;
        setAllocs({...allocs, [name]: value });
      };

      const [status, setStatus] = useState([]);

  const fetchStatus = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/registat/actif")
  .then(response => response.data["hydra:member"]);
  setStatus(data)
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchStatus();
  }, []);

    const [ouverts, setOuverts] = useState([]);

  const fetchOuverts = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/ouverts")
  .then(response => response.data["hydra:member"]);
  setOuverts(data)
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchOuverts();
  }, []);

      const handleSubmit = async event => {
        event.preventDefault();
        console.log(allocs)
    
       try {
         await AllocAPI.create({...allocs,
          mairieCommunale:`/api/mairies/${allocs.mairieCommunale}`,
          creditOuvert:`/api/ouverts/${allocs.creditOuvert}`})
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
            Cr??dit allou??
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/credit-alloue/new"
              >
                Cr??ation
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-alloue"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-alloue"
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
                              value={allocs.compteNature}
                              onChange={handleChange}
                              onClick={() => fetchArts(allocs.compteNature)}
                              //onClick={() => fetchLibelles(creds.compteNature)}
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
                              value={allocs.compteNature}
                              onChange={handleChange}
                             onClick={() => fetchParas(allocs.compteNature)}
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
                              value={allocs.compteNature}
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
                  <label className="col-form-label">Num??ro du comptes </label>
                </div>
                <div className="col-sm-4">
                 <select 
                  onChange={handleChange} 
                  name="CompteNature"
                  id="CompteNature"
                  value={allocs.creditOuvert}
                  className="form-control"
                 >
                   {}
                    </select>
                   </div>

                  <div className="col-sm-2">
                   <label className="col-form-label">Montant du cr??dit ouvert</label>
                  </div>
                    <div className="col-sm-4">
                 <select 
                   disabled="disabled"
                  onChange={handleChange} 
                  name="allocitOuvert"
                  id="allocitOuvert"
                  value={allocs.creditOuvert}
                  className="form-control"
                 ><option value="">...</option>
                   {}
                   </select>
                   </div>
                    
                  </div>

                  <div className="row form-group">
                  <div className="col-sm-2">
                  <label className="col-form-label">Mairie communale</label>
                </div>
                <div className="col-sm-4">
                    <select 
                  id="mairieCommunale"
                    onChange={handleChange} 
                    name="mairieCommunale"
                    className={"form-control"}
                    value={allocs.mairieCommunale}
                   >
                     {mairies.map(mairie => <option key={mairie.id} value={mairie.id}>
                       {mairie.designationMairie} 
                     </option>)}
                      </select>
                     </div>
                <div className="col-sm-2">
                  <label className="col-form-label">Montant allou??</label>
                </div>
                <div className="col-sm-4">
                <input 
                  id="montantAllouer"
                  type="number"
                  name="montantAllouer"
                  value={allocs.montantAllouer}
                  onChange={handleChange}
                  className={"form-control" + (error && " is-invalid")} />
                   </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea
                    onChange={handleChange} 
                    name="descriptionAllocation"
                    id="descriptionAllocation"
                    value={allocs.descriptionAllocation}
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

export default InscriAlloc;