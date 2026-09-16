import { httpClient } from "../utils/httpClient.js";

export const tareaService = {
  async getAll(statusId = 0) {
    const query = statusId > 0 ? `?status=${statusId}` : "";
    return await httpClient.get(`/api/tareas/${query}`);
  },

  async getById(id) {
    return await httpClient.get(`/api/tareas/${id}`);
  },

  async save(data) {
    if (data.id) {
      return await httpClient.put(`/api/tareas/${data.id}`, data);
    }
    return await httpClient.post("/api/tareas", data);
  },

  async toggleStatus(id, newStatusId) {
    return await httpClient.patch(`/api/tareas/${id}/status`, {
      status_id: newStatusId,
    });
  },

  async delete(id) {
    return await httpClient.delete(`/api/tareas/${id}`);
  },
};
