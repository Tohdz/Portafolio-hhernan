
package com.ProyectoFinal.ProyectoFinal.service;

import com.ProyectoFinal.ProyectoFinal.domain.Emulador;
import java.util.List;

public interface EmuladorService {
    public List<Emulador> getEmuladores();
    public Emulador getEmulador(Emulador emulador);
    public void save(Emulador emulador);
    public void delete(Emulador emulador);
}
