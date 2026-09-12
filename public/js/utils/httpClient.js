import { API_BASE_URL } from "../config.js";

export const httpClient = async (endpoint, options = {}) => {
  const defaultHeaders = {
    "X-Requested-With": "XMLHttpRequest",
    "Content-Type": "application/json",
  };

  // Construcción de URL limpia
  const url = `${API_BASE_URL}${endpoint}`;

  const config = {
    ...options,
    headers: {
      ...defaultHeaders,
      ...options.headers,
    },
  };

  try {
    const response = await fetch(url, config);

    if (!response.ok) {
      throw new Error(`Error ${response.status}: ${response.statusText}`);
    }
    return await response.json();
  } catch (error) {
    console.error("HTTP Client Error:", error);
    throw error;
  }
};
