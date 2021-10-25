import axios from "axios";
import React, {useState, useEffect} from "react";

const InscriExerc = () =>{

  const [exercs, setExercs] = useState({
    anneeExercice: "2024",
    ordonateurExercice: "Bourahima",
    dateVote: "",
    dateAdoption: "",
    description: "",
    nomenclature: ""
  });

  const [ouvrs, setOuvrs] = useState({
    statut: "Primitif",
    exerciceRegistre: ""
  });

  const [nomenclatures, setNomens] = useState([]);
    
  const fetchNomen = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/nomenclatures?estActif=true")
  .then(response => response.data["hydra:member"]);
    setNomens(data);
    if (!exercs.nomenclature) setExercs({...exercs, nomenclature:data[0].id} )
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchNomen();
  }, []);


  const [error, setError] = useState("");

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setExercs({...exercs, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      const response = await axios
      .post("http://localhost:8000/api/registres", {...exercs,
      nomenclature:`/api/nomenclatures/${exercs.nomenclature}`})
      console.log(response.data);
    } catch(error) {
      console.log(response.error);
     setError("Informations incorrectes")
    }
   
  };
  const [registres, setRegistres] = useState([]);
    
  const fetchRegistres = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/registres")
  .then(response => response.data["hydra:member"]);
    setRegistres(data);
    if (!ouvrs.exerciceRegistre) setRegistres({...ouvrs, exerciceRegistre:data[0].id} )
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchRegistres();
  }, []);

  const handleSubmit1 = async event => {
    event.preventDefault();

    try {
      const response = await axios
      .post("http://localhost:8000/api/registats", {...ouvrs,
      registre:`/api/registres/${ouvrs.registre}`})
      console.log(response.data);
    } catch(error) {
      console.log(response.error);
     setError("Informations incorrectes")
    }
   
  };

  const handleChange1 = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setOuvrs({...ouvrs, [name]: value });
  };

  return (
    <section id="exp">
    <div className="product-detail-page">
      <h3 className="card-header">
        <div className="row">
        <div className="text-left col-sm-6">
        EXERCICE
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
            href="#/sbu/exercice/new"
          >
            Ouverture
          </a>
          <div className="slide" />
        </li>
        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/modif-exercice"
          >
            Modification
          </a>
          <div className="slide" />
        </li>
         <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/clos-exercice"
          >
            Clôture
          </a>
          <div className="slide" />
        </li>
        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/exercice"
          >
            Consultation
          </a>
          <div className="slide" />
        </li>
      </ul>
   <div className="page-body">
  <div className="row">
    <div className="col-xl-6 col-md-12">
      <div className="card table-card">
        <div className="card-header">
          <h5>Recent Tickets</h5>
        </div>
        <div className="card-block">
          <div className="table-responsive">
          <div className="card-block">
    <form onSubmit={handleSubmit}>
        <div className="row form-group">
          <div className="col-sm-2">
            <label className="col-form-label">Année *</label>
          </div>
          <div className="col-sm-3">
            <input
              name="anneeExercice"
              type="number"
              className={"form-control required" + (error && " is-invalid")}
              value={exercs.anneeExercice}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
          <div className="col-sm-2">
              <label className="col-form-label">Nomenclature</label>
            </div>
              <div className="col-sm-2">
              <select 
              disabled="disabled"
              onChange={handleChange} 
              name="nomenclature"
              id="nomenclature"
              value={exercs.nomenclature}
              className={"form-control" + (error && " is-invalid")}
             >
               {nomenclatures.map(nomenclature => <option key={nomenclature.id} value={nomenclature.id}>
                 {nomenclature.anneeApplication}
               </option>)}
                </select>
              </div>
        </div>
       
        <div className="row form-group">
          <div className="col-sm-2">
            <label className="col-form-label">Ordonnateur *</label>
          </div>
          <div className="col-sm-10">
            <input
              id="ordonateurExercice"
              name="ordonateurExercice"
              type="text"
              className={"form-control required" + (error && " is-invalid")}
              data-a-sign="MR. "
              value={exercs.ordonateurExercice}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
        </div>
        <div className="row form-group">
          <div className="col-sm-2">
            <label className="col-form-label">Date de vote *</label>
          </div>
          <div className="col-sm-4">
            <input
              id="dateVote"
              name="dateVote"
              type="date"
              className={"form-control required" + (error && " is-invalid")}
              data-a-sign="MR. "
              value={exercs.dateVote}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
       
          <div className="col-sm-2">
            <label className="col-form-label">Date d'adoption *</label>
          </div>
          <div className="col-sm-4">
            <input
              id="dateAdoption"
              name="dateAdoption"
              type="date"
              className={"form-control required" + (error && " is-invalid")}
              data-a-sign="MR. "
              value={exercs.dateAdoption}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
        </div>
        <div className="row form-group">
          <div className="col-sm-2">
            <label className="col-form-label">Description</label>
          </div>
          <div className="col-sm-10">
            <textarea 
            id="description"
            name="description"
            type="text" 
            className={"form-control required" + (error && " is-invalid")} 
             value={exercs.description}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
        </div>
        <div className="text-right col-sm-12">
          <button 
         
          type="submit" 
          className="btn btn-primary">
            Créer
          </button>
        </div>
      </form>
      </div>
           
          </div>
        </div>
      </div>
    </div>
    <div className="col-xl-6 col-md-12">
      <div className="card latest-update-card">
        <div className="card-header">
          <h5>Latest Updates</h5>
          <div className="card-header-right">
            <ul className="list-unstyled card-option">
              <li><i className="fa fa fa-wrench open-card-option" /></li>
              <li><i className="fa fa-window-maximize full-card" /></li>
              <li><i className="fa fa-minus minimize-card" /></li>
              <li><i className="fa fa-refresh reload-card" /></li>
              <li><i className="fa fa-trash close-card" /></li>
            </ul>
          </div>
        </div>
        <div className="card-block">
          <div className="latest-update-box">
            <div className="row p-t-20 p-b-30">
              <div className="col-auto text-right update-meta">
                <p className="text-muted m-b-0 d-inline">2 hrs ago</p>
                <i className="feather icon-twitter bg-info update-icon" />
              </div>
              <div className="col">
                <h6>+ 1652 Followers</h6>
                <p className="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>
              </div>
            </div>
            <div className="row p-b-30">
              <div className="col-auto text-right update-meta">
                <p className="text-muted m-b-0 d-inline">4 hrs ago</p>
                <i className="feather icon-briefcase bg-simple-c-pink update-icon" />
              </div>
              <div className="col">
                <h6>+ 5 New Products were added!</h6>
                <p className="text-muted m-b-0">Congratulations!</p>
              </div>
            </div>
            <div className="row p-b-30">
              <div className="col-auto text-right update-meta">
                <p className="text-muted m-b-0 d-inline">1 day ago</p>
                <i className="feather icon-check bg-simple-c-yellow  update-icon" />
              </div>
              <div className="col">
                <h6>Database backup completed!</h6>
                <p className="text-muted m-b-0">Download the <span className="text-c-blue">latest backup</span>.</p>
              </div>
            </div>
            <div className="row p-b-0">
              <div className="col-auto text-right update-meta">
                <p className="text-muted m-b-0 d-inline">2 day ago</p>
                <i className="feather icon-facebook bg-simple-c-green update-icon" />
              </div>
              <div className="col">
                <h6>+2 Friend Requests</h6>
                <p className="text-muted m-b-10">This is great, keep it up!</p>
                <div className="table-responsive">
                  <table className="table table-hover">
                    <tbody><tr>
                        <td className="b-none">
                          <a href="#!" className="align-middle">
                            <img src="..\files\assets\images\avatar-2.jpg" alt="user image" className="img-radius img-40 align-top m-r-15" />
                            <div className="d-inline-block">
                              <h6>Jeny William</h6>
                              <p className="text-muted m-b-0">Graphic Designer</p>
                            </div>
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td className="b-none">
                          <a href="#!" className="align-middle">
                            <img src="..\files\assets\images\avatar-1.jpg" alt="user image" className="img-radius img-40 align-top m-r-15" />
                            <div className="d-inline-block">
                              <h6>John Deo</h6>
                              <p className="text-muted m-b-0">Web Designer</p>
                            </div>
                          </a>
                        </td>
                      </tr>
                    </tbody></table>
                </div>
              </div>
            </div>
          </div>
          <div className="text-center">
            <a href="#!" className="b-b-primary text-primary">View all Projects</a>
          </div>
        </div>
      </div>
    </div>
    {/* ticket and update end */}
    <div className="col-md-12">
      <div className="card table-card">
        <div className="card-header">
          <h5>Application Sales</h5>
          <div className="card-header-right">
            <ul className="list-unstyled card-option">
              <li><i className="feather icon-maximize full-card" /></li>
              <li><i className="feather icon-minus minimize-card" /></li>
              <li><i className="feather icon-trash-2 close-card" /></li>
            </ul>
          </div>
        </div>
        <div className="card-block">
          <div className="table-responsive">
            <table className="table table-hover  table-borderless">
              <thead>
                <tr>
                  <th>
                    <div className="chk-option">
                      <div className="checkbox-fade fade-in-primary">
                        <label className="check-task">
                          <input type="checkbox" defaultValue />
                          <span className="cr">
                            <i className="cr-icon feather icon-check txt-default" />
                          </span>
                        </label>
                      </div>
                    </div>
                    Application</th>
                  <th>Sales</th>
                  <th>Change</th>
                  <th>Avg Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div className="chk-option">
                      <div className="checkbox-fade fade-in-primary">
                        <label className="check-task">
                          <input type="checkbox" defaultValue />
                          <span className="cr">
                            <i className="cr-icon feather icon-check txt-default" />
                          </span>
                        </label>
                      </div>
                    </div>
                    <div className="d-inline-block align-middle">
                      <h6>Able Pro</h6>
                      <p className="text-muted m-b-0">Powerful Admin Theme</p>
                    </div>
                  </td>
                  <td>16,300</td>
                  <td><canvas id="app-sale1" height={50} width={100} /></td>
                  <td>$53</td>
                  <td className="text-c-blue">$15,652</td>
                </tr>
                <tr>
                  <td>
                    <div className="chk-option">
                      <div className="checkbox-fade fade-in-primary">
                        <label className="check-task">
                          <input type="checkbox" defaultValue />
                          <span className="cr">
                            <i className="cr-icon feather icon-check txt-default" />
                          </span>
                        </label>
                      </div>
                    </div>
                    <div className="d-inline-block align-middle">
                      <h6>Photoshop</h6>
                      <p className="text-muted m-b-0">Design Software</p>
                    </div>
                  </td>
                  <td>26,421</td>
                  <td><canvas id="app-sale2" height={50} width={100} /></td>
                  <td>$35</td>
                  <td className="text-c-blue">$18,785</td>
                </tr>
                <tr>
                  <td>
                    <div className="chk-option">
                      <div className="checkbox-fade fade-in-primary">
                        <label className="check-task">
                          <input type="checkbox" defaultValue />
                          <span className="cr">
                            <i className="cr-icon feather icon-check txt-default" />
                          </span>
                        </label>
                      </div>
                    </div>
                    <div className="d-inline-block align-middle">
                      <h6>Guruable</h6>
                      <p className="text-muted m-b-0">Best Admin Template</p>
                    </div>
                  </td>
                  <td>8,265</td>
                  <td><canvas id="app-sale3" height={50} width={100} /></td>
                  <td>$98</td>
                  <td className="text-c-blue">$9,652</td>
                </tr>
                <tr>
                  <td>
                    <div className="chk-option">
                      <div className="checkbox-fade fade-in-primary">
                        <label className="check-task">
                          <input type="checkbox" defaultValue />
                          <span className="cr">
                            <i className="cr-icon feather icon-check txt-default" />
                          </span>
                        </label>
                      </div>
                    </div>
                    <div className="d-inline-block align-middle">
                      <h6>Flatable</h6>
                      <p className="text-muted m-b-0">Admin App</p>
                    </div>
                  </td>
                  <td>10,652</td>
                  <td><canvas id="app-sale4" height={50} width={100} /></td>
                  <td>$20</td>
                  <td className="text-c-blue">$7,856</td>
                </tr>
              </tbody>
            </table>
            <div className="text-center">
              <a href="#!" className=" b-b-primary text-primary">View all Projects</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    {/* latest activity end */}
    <div className="col-xl-8 col-md-12">
      <div className="card latest-activity-card">
        <div className="card-header">
          <h5>Latest Activity</h5>
        </div>
        <div className="card-block">
          <div className="latest-update-box">
            <div className="row p-t-20 p-b-30">
              <div className="col-auto text-right update-meta">
                <p className="text-muted m-b-0 d-inline">just now</p>
                <i className="feather icon-sunrise bg-simple-c-blue update-icon" />
              </div>
              <div className="col">
                <h6>John Deo</h6>
                <p className="text-muted m-b-15">The trip was an amazing and a life changing experience!!</p>
                <img src="..\files\assets\images\mega-menu\01.jpg" alt className="img-fluid img-100 m-r-15 m-b-10" />
                <img src="..\files\assets\images\mega-menu\03.jpg" alt className="img-fluid img-100 m-r-15 m-b-10" />
              </div>
            </div>
            <div className="row p-b-30">
              <div className="col-auto text-right update-meta">
                <p className="text-muted m-b-0 d-inline">5 min ago</p>
                <i className="feather icon-file-text bg-simple-c-blue update-icon" />
              </div>
              <div className="col">
                <h6>Administrator</h6>
                <p className="text-muted m-b-0">Free courses for all our customers at A1 Conference Room - 9:00 am tomorrow!</p>
              </div>
            </div>
            <div className="row p-b-30">
              <div className="col-auto text-right update-meta">
                <p className="text-muted m-b-0 d-inline">3 hours ago</p>
                <i className="feather icon-map-pin bg-simple-c-blue update-icon" />
              </div>
              <div className="col">
                <h6>Jeny William</h6>
                <p className="text-muted m-b-15">Happy Hour! Free drinks at <span className="text-c-blue">Cafe-Bar all </span>day long!</p>
                <div id="markers-map" style={{height: 200, width: '100%'}} />
              </div>
            </div>
          </div>
          <div className="text-right">
            <a href="#!" className=" b-b-primary text-primary">View all Activity</a>
          </div>
        </div>
      </div>
    </div>
    <div className="col-xl-4 col-md-12">
      <div className="card feed-card">
        <div className="card-header">
          <h5>Upcoming Deadlines</h5>
          <div className="card-header-right">
            <ul className="list-unstyled card-option">
              <li><i className="fa fa fa-wrench open-card-option" /></li>
              <li><i className="fa fa-window-maximize full-card" /></li>
              <li><i className="fa fa-minus minimize-card" /></li>
              <li><i className="fa fa-refresh reload-card" /></li>
              <li><i className="fa fa-trash close-card" /></li>
            </ul>
          </div>
        </div>
        <div className="card-block">
          <div className="row m-b-25">
            <div className="col-auto p-r-0">
              <img src="..\files\assets\images\mega-menu\01.jpg" alt className="img-fluid img-50" />
            </div>
            <div className="col">
              <h6 className="m-b-5">New able - Redesign</h6>
              <p className="text-c-pink m-b-0">2 Days Remaining</p>
            </div>
          </div>
          <div className="row m-b-25">
            <div className="col-auto p-r-0">
              <img src="..\files\assets\images\mega-menu\02.jpg" alt className="img-fluid img-50" />
            </div>
            <div className="col">
              <h6 className="m-b-5">New Admin Dashboard</h6>
              <p className="text-c-pink m-b-0">Proposal in 6 Days</p>
            </div>
          </div>
          <div className="row m-b-25">
            <div className="col-auto p-r-0">
              <img src="..\files\assets\images\mega-menu\03.jpg" alt className="img-fluid img-50" />
            </div>
            <div className="col">
              <h6 className="m-b-5">Logo Design</h6>
              <p className="text-c-green m-b-0">10 Days Remaining</p>
            </div>
          </div>
          <div className="text-center">
            <a href="#!" className="b-b-primary text-primary">View all Feeds</a>
          </div>
        </div>
      </div>
      <div className="card feed-card">
        <div className="card-header">
          <h5>Feeds</h5>
        </div>
        <div className="card-block">
          <div className="row m-b-30">
            <div className="col-auto p-r-0">
              <i className="feather icon-bell bg-simple-c-blue feed-icon" />
            </div>
            <div className="col">
              <h6 className="m-b-5">You have 3 pending tasks. <span className="text-muted f-right f-13">Just Now</span></h6>
            </div>
          </div>
          <div className="row m-b-30">
            <div className="col-auto p-r-0">
              <i className="feather icon-shopping-cart bg-simple-c-pink feed-icon" />
            </div>
            <div className="col">
              <h6 className="m-b-5">New order received <span className="text-muted f-right f-13">Just Now</span></h6>
            </div>
          </div>
          <div className="row m-b-30">
            <div className="col-auto p-r-0">
              <i className="feather icon-file-text bg-simple-c-green feed-icon" />
            </div>
            <div className="col">
              <h6 className="m-b-5">You have 3 pending tasks. <span className="text-muted f-right f-13">Just Now</span></h6>
            </div>
          </div>
          <div className="row m-b-20">
            <div className="col-auto p-r-0">
              <i className="feather icon-shopping-cart bg-simple-c-pink feed-icon" />
            </div>
            <div className="col">
              <h6 className="m-b-5">New order received <span className="text-muted f-right f-13">Just Now</span></h6>
            </div>
          </div>
          <div className="text-center">
            <a href="#!" className="b-b-primary text-primary">View all Feeds</a>
          </div>
        </div>
      </div>
    </div>
    {/* latest activity end */}
    <div className="col-xl-4 col-md-12">
      <div className="card user-activity-card">
        <div className="card-header">
          <h5>User Activity</h5>
        </div>
        <div className="card-block">
          <div className="row m-b-25">
            <div className="col-auto p-r-0">
              <div className="u-img">
                <img src="..\files\assets\images\breadcrumb-bg.jpg" alt="user image" className="img-radius cover-img" />
                <img src="..\files\assets\images\avatar-2.jpg" alt="user image" className="img-radius profile-img" />
              </div>
            </div>
            <div className="col">
              <h6 className="m-b-5">John Deo</h6>
              <p className="text-muted m-b-0">Lorem Ipsum is simply dummy text.</p>
              <p className="text-muted m-b-0"><i className="feather icon-clock m-r-10" />2 min ago</p>
            </div>
          </div>
          <div className="row m-b-25">
            <div className="col-auto p-r-0">
              <div className="u-img">
                <img src="..\files\assets\images\breadcrumb-bg.jpg" alt="user image" className="img-radius cover-img" />
                <img src="..\files\assets\images\avatar-2.jpg" alt="user image" className="img-radius profile-img" />
              </div>
            </div>
            <div className="col">
              <h6 className="m-b-5">John Deo</h6>
              <p className="text-muted m-b-0">Lorem Ipsum is simply dummy text.</p>
              <p className="text-muted m-b-0"><i className="feather icon-clock m-r-10" />2 min ago</p>
            </div>
          </div>
          <div className="row m-b-25">
            <div className="col-auto p-r-0">
              <div className="u-img">
                <img src="..\files\assets\images\breadcrumb-bg.jpg" alt="user image" className="img-radius cover-img" />
                <img src="..\files\assets\images\avatar-2.jpg" alt="user image" className="img-radius profile-img" />
              </div>
            </div>
            <div className="col">
              <h6 className="m-b-5">John Deo</h6>
              <p className="text-muted m-b-0">Lorem Ipsum is simply dummy text.</p>
              <p className="text-muted m-b-0"><i className="feather icon-clock m-r-10" />2 min ago</p>
            </div>
          </div>
          <div className="text-center">
            <a href="#!" className="b-b-primary text-primary">View all Projects</a>
          </div>
        </div>
      </div>
    </div>
    <div className="col-xl-8 col-md-12">
      <div className="card table-card">
        <div className="card-header">
          <h5>Global Sales by Top Locations</h5>
        </div>
        <div className="card-block">
          <div className="table-responsive">
            <table className="table table-hover table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Country</th>
                  <th>Sales</th>
                  <th className="text-right">Average</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><img src="..\files\assets\images\widget\GERMANY.jpg" alt className="img-fluid img-30" /></td>
                  <td>Germany</td>
                  <td>3,562</td>
                  <td className="text-right">56.23%</td>
                </tr>
                <tr>
                  <td><img src="..\files\assets\images\widget\USA.jpg" alt className="img-fluid img-30" /></td>
                  <td>USA</td>
                  <td>2,650</td>
                  <td className="text-right">25.23%</td>
                </tr>
                <tr>
                  <td><img src="..\files\assets\images\widget\AUSTRALIA.jpg" alt className="img-fluid img-30" /></td>
                  <td>Australia</td>
                  <td>956</td>
                  <td className="text-right">12.45%</td>
                </tr>
                <tr>
                  <td><img src="..\files\assets\images\widget\UK.jpg" alt className="img-fluid img-30" /></td>
                  <td>United Kingdom</td>
                  <td>689</td>
                  <td className="text-right">8.65%</td>
                </tr>
                <tr>
                  <td><img src="..\files\assets\images\widget\BRAZIL.jpg" alt className="img-fluid img-30" /></td>
                  <td>Brazil</td>
                  <td>560</td>
                  <td className="text-right">3.56%</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div className="text-right  m-r-20">
            <a href="#!" className="b-b-primary text-primary">View all Sales Locations </a>
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

export default InscriExerc ;
