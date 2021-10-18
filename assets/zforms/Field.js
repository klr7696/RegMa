import React from 'react';

export const Field = ({
    name,
    label,
    value,
    onChange,
    placeholder,
    type = "text",
    error = "",
    maxLength,
    required
}) => (
    <div className="form-group row">
    <div className="col-sm-2">
         <label className="col-form-label" htmlFor={name}> {label} </label>
    </div>
    <div className="col-sm-3">
            <input 
            value={value}
            onChange={onChange}
            type={type}
            placeholder={placeholder || label }
            name={name}
            id={name}
            className={"form-control" + (error && " is-invalid")}
            maxLength={maxLength}
            error={error}
            required={required}
        />
        {error && <p className="invalid-feedback">{error}</p> }
        </div>
    </div>
);


export const Field1 = ({
    name,
    label,
    value,
    onChange,
    placeholder,
    type = "text",
    error = "",
    maxLength,
    required
}) => (
    <div className="form-group">
    <div className="col-sm-2">
         <label className="col-form-label" htmlFor={name}> {label} </label>
    </div>
    <div className="col-sm-3">
            <textarea 
            value={value}
            onChange={onChange}
            type={type}
            placeholder={placeholder || label }
            name={name}
            id={name}
            className={"form-control" + (error && " is-invalid")}
            maxLength={maxLength}
            error={error}
            required={required}
        />
        {error && <p className="invalid-feedback">{error}</p> }
        </div>
    </div>
);