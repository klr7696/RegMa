import axios from "axios";
import React, {useEffect, useState } from "react";
import { ColumnDirective, ColumnsDirective, Filter, Inject, Page, TreeGridComponent } from '@syncfusion/ej2-react-treegrid';
import { Link } from "react-router-dom";


const ConsultNature = () => {


const [compte, setCompte] = useState([]);

    useEffect(() => {
      axios
        .get("http://localhost:8000/api/natures")
        .then(response => response.data["hydra:member"])
        .then(data => setCompte(data));
    }, []);
  
    return (
        <section id="exp">
        <div className="product-detail-page">
          <h3 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            Classification par nature 
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
    <Link to="/compte/new" className="btn btn-primary">Ajouter de Nouveau</Link>
    </div>   
       <TreeGridComponent dataSource={compte}
        childMapping='sousCompteNature' height='420' allowPaging='true' allowFiltering='true' 
       filterSettings={{ mode: 'Immediate', type: 'FilterBar', hierarchyMode: 'Parent' }}>
        <ColumnsDirective>
          <ColumnDirective field='numeroCompteNature' headerText='Numéro' width='90'></ColumnDirective>
          <ColumnDirective field='hierachieCompteNature' headerText='Hiérarchie' width='90' />
          <ColumnDirective field='libelleCompteNature' headerText='Libéllé' width='200' />
          <ColumnDirective field='sectionCompteNature' headerText='Section' width='100'/>
          <ColumnDirective field='compteNature' headerText='oj' width='100'/>
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
 
export default ConsultNature;