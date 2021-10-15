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
    <div className="j-content">
         <label className="j-label" htmlFor={name}> {label} </label>
            <input 
            value={value}
            onChange={onChange}
            type={type}
            placeholder={placeholder || label }
            name={name}
            id={name}
            className={"form-control" + (error && "is-invalid")}
            maxLength={maxLength}
            error={error}
            required={required}
        />
        {error && <p className="invalid-feedback">{error}</p> }
        
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
    <div className="j-content">
         <label className="j-label" htmlFor={name}> {label} </label>
            <textarea 
            value={value}
            onChange={onChange}
            type={type}
            placeholder={placeholder || label }
            name={name}
            id={name}
            className={"form-control" + (error && "is-invalid")}
            maxLength={maxLength}
            error={error}
            required={required}
        />
        {error && <p className="invalid-feedback">{error}</p> }
        
        </div>
);