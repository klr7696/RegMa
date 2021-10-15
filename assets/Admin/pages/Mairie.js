import React, { useState, useEffect } from "react";
import { toast } from "react-toastify";
import MairiesAPI from "../../zservices/mairieAPI";
import { Field, Field1 } from "../../zforms/Field";
import { Component } from 'react';

const CreatMairie = ({ match, history }) => {
  const {id = "new"} = match.params;

  const [mairie, setMairie] = useState({
    designationMairie: "",
    abbreviationMairie: "",
    adresseMairie: "",
    descriptionMairie: `{/api/profils.id}`
    
  });

 const [errors, setErrors] = useState({
    designationMairie: "",
    abbreviationMairie: "",
    adresseMairie: "",
    descriptionMairie: "",
  });

  const [editing, setEditing] = useState(false);

  const fetchMairie = async (id) => {
    try {
      const { designationMairie, abbreviationMairie, adresseMairie, descriptionMairie } = await MairiesAPI.find(id);
      setMairie({ designationMairie, abbreviationMairie, adresseMairie, descriptionMairie });
    } catch (error) {
      history.replace("/mairies/liste");
    }
  };

  useEffect(() => {
    if (id !== "new") {
      setEditing(true);
      fetchMairie(id);
    }
  }, [id]);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setMairie({ ...mairie, [name]: value });
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    try {
      if (editing) {
        await MairiesAPI.update(id, mairie);
        toast.success("Mairie modifié");
      } else {
        await MairiesAPI.create(mairie);
        toast.error("Mairie Ajoutée");
        history.replace("/mairies/liste");
      }
      setErrors({});
    } catch ({ response }) {
      const { violations } = response.data;

      if (violations) {
        const apiErrors = {};
        violations.forEach(({ propertyPath, message }) => {
          apiErrors[propertyPath] = message;
        });

        setErrors(apiErrors);
        toast.error("Erreur");
      }
    }
  };
    return (
      <div className="page-body">
        <div className="row">
          <div className="col-sm-12">
            <div className="card-block">
           <form onSubmit={handleSubmit} className="j-pro">
          <Field
            label="Désignation"
            type="text"
            name="designationMairie"
            placeholder="Désignation de la mairie"
            value={mairie.designationMairie}
            onChange={handleChange}
            error={errors.designationMairie}
            />
             <Field
            label="Sigle"
            type="text"
            name="abbreviationMairie"
            placeholder="abbreviation de la mairie"
            value={mairie.abbreviationMairie}
            onChange={handleChange}
            error={errors.abbreviationMairie}
            />
            designationMairie, , , 
             <Field
            label="Adresse"
            type="text"
            name="adresseMairie"
            placeholder="l'adresse de la mairie"
            value={mairie.adresseMairie}
            onChange={handleChange}
            error={errors.adresseMairie}
            />
             <Field1
            label="Description"
            type="text"
            name="descriptionMairie"
            placeholder="description de la mairie"
            value={mairie.descriptionMairie}
            onChange={handleChange}
            error={errors.descriptionMairie}
            />
                
                <div className="text-right col-sm-9">
                  <button type="submit" className="btn btn-primary">Enregistrer</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  };
  
  const ConsultMairie = () => {
    return (
      <div className="page-body">
        <div className="card-block">
        <h5 className="card-header-text">Listes des Bailleurs de fonds</h5>
          <div className="table-responsive dt-responsive">
            <table
              id="lang-file"
              className="table table-striped table-bordered nowrap"
            >
              <thead>
                <tr>
                  <th>Désignation</th>
                  <th>Sigle</th>
                  <th>Catégorie</th>
                  <th>Code</th>
                  <th>Source Financement</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Commune</td>
                  <td>BC</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Tiger Nixon</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    );
  };
   
  class Mairie extends Component {
    render() {
      return (
        <section id="exp">
          <div></div>
          <div class="product-detail-page">
            <h3 className="card-header">
              <div className="row">
               <div className="text-left col-sm-6">
                Mairie
              </div>
              <div className="text-right col-sm-6">
                  <button className="btn-sm btn-secondary">
                    Gestion 2021
                  </button>
                </div>
              </div>
            </h3>
            <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
              <li className="nav-item">
                <a
                  className="nav-link active f-18 p-b-0"
                  data-toggle="tab"
                  href="#creation"
                  role="tab"
                >
                  Création
                </a>
                <div className="slide" />
              </li>
  
              <li className="nav-item m-b-0">
                <a
                  className="nav-link f-18 p-b-0"
                  data-toggle="tab"
                  href="#consultation"
                  role="tab"
                >
                  Consultation
                </a>
                <div className="slide" />
              </li>
  
            </ul>
            <div className="card">
              <div className="card-block">
                <div className="tab-content bg-white">
                  <div className="tab-pane active" id="creation" role="tabpanel">
                    <CreatMairie />
                  </div>
                  <div className="tab-pane" id="consultation" role="tabpanel">
                    <ConsultMairie/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      );
    }
  }
 
export default Mairie;