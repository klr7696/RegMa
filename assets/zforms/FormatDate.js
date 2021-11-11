import React from 'react';
import moment from "moment";

const FormatDate = (str) => moment(str).format('DD/MM/YYYY');

export default FormatDate;