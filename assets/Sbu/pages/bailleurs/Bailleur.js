import axios from "axios";
import React, { Component} from "react";
import InscriBailleur from "./InscriBailleur";
import ConsultBaill from "./InscriBailleur";


const Bailleur = () => {
    return (
      <section id="exp">
        <div className="product-detail-page">
          <h3 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            BAILLEUR DE FONDS 
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
                href="#enregistrement"
                role="tab"
              >
                Enregistrement
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
                Consulter
              </a>
              <div className="slide" />
            </li>

          </ul>
          <div className="card">
            <div className="card-block">
              <div className="tab-content bg-white">
                <div className="tab-pane active" id="enregistrement" role="tabpanel">
                  <InscriBailleur/>
                </div>
                <div className="tab-pane" id="consultation" role="tabpanel">
                  <ConsultBaill/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }

export default Bailleur;
