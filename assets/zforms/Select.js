import React from 'react';

const Select = (name, value, error, label, onChange, children) => {
    return ( 
        <div className="row form-group">
          <div className="col-sm-1">
                  <label htmlFor={name} className="col-form-label">{label}</label>
            </div>
                <div className="col-sm-3">
                  <select 
                  onChange={onChange} 
                  name={name} 
                  id={name} 
                  value={value}
                  className={"form-control" + (error && " is-invalid")}
                  >
                    {children}
                  </select>
                  <p className="invalid-feedback">{error}</p>
                </div>   
        </div>
     );
}
 
export default Select;