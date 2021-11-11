import axios from "axios";
import React, {useEffect, useState } from "react";
import { ColumnDirective, ColumnsDirective, Filter, Inject, Page, TreeGridComponent } from '@syncfusion/ej2-react-treegrid';
import OuvriExerc from "../../../Sbu/pages/Exercice/OuvriExerc";

const ConsultFonction = () => {

const [compte, setCompte] = useState([]);

    const [nomenclatures, setNomens] = useState([]);

    const fetchNomen = async () => {
      try{
    const data = await axios
    .get("http://localhost:8000/api/nomenclatures")
    .then(response => response.data["hydra:member"]);
      setNomens(data);
      } catch (error) {
      console.log(error);
      }
    };
  
    useEffect(() =>{
        fetchNomen();
        axios
        .get(`http://localhost:8000/api/nomenclatures/1/natures`)
        .then(response => response.data["hydra:member"])
        .then(data => setCompte(data));
    }, []);

    const handleChange = ({ currentTarget }) => {
      const { name, value } = currentTarget;
      setCompte({...compte, [name]: value });
    };
  
    return (
        <section id="exp">
        <div className="product-detail-page">
        <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
            Classification par fonction 
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/chap/new"
              >
                Chapitre
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/arti/new"
              >
                Article
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/para/new"
              >
                Paragraphe
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/compte-nature"
              >
                Consultation
              </a>
              <div className="slide" />
            </li>
    
          </ul>
          <div className="card">
            <div className="card-block">
             
              <div className="page-body">
            <div className="card-block">
        <div className="table-responsive dt-responsive">
        <div className='control-pane'>
    <div className='control-section'>
     <div className='col-md-12'>
    <div className="mb-1 d-flex justify-content-between align-items-center">
    <h4>Liste de lignes budgétaires</h4>
    <div className="col-sm-2">
              <label className="col-form-label">Nomenclature</label>
      </div>
              <div className="col-sm-3">
              <select 
              onChange={handleChange} 
              name="nomenclature"
              id="nomenclature"
              value={compte.nomenclature}
              className="form-control"
             >
               {nomenclatures.map(nomenclature => <option key={nomenclature.id} value={nomenclature.id}>
                 {nomenclature.anneeApplication}
               </option>)}
                </select>
              </div>
    </div>   
       <TreeGridComponent dataSource={compte}
        childMapping='sousCompteNature' height='420' allowPaging='true' allowFiltering='true' 
       filterSettings={{ mode: 'Immediate', type: 'FilterBar', hierarchyMode: 'Parent' }}>
        <ColumnsDirective>
          <ColumnDirective field='numeroCompteNature' headerText='Numéro' width='90'></ColumnDirective>
          <ColumnDirective field='hierachieCompteNature' headerText='Hiérarchie' width='90' />
          <ColumnDirective field='libelleCompteNature' headerText='Libéllé' width='200' />
          <ColumnDirective field='sectionCompteNature' headerText='Section' width='100'/>
        </ColumnsDirective>
        <Inject services={[Filter, Page]}/>
      </TreeGridComponent>
    </div>
   </div>
    </div>
           </div>
           </div></div>
               </div>
               </div>
        </div>
  </section>
     );
}
 
export default ConsultFonction;