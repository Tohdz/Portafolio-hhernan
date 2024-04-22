package com.ProyectoFinal.ProyectoFinal.controller;

import com.ProyectoFinal.ProyectoFinal.domain.Noticia;
import com.ProyectoFinal.ProyectoFinal.service.NoticiaService;
import java.io.IOException;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import org.springframework.core.io.FileSystemResource;
import org.springframework.core.io.ResourceLoader;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.core.io.Resource;

@Controller
@Slf4j
@RequestMapping("/noticia")
public class NoticiasController {

    @Autowired
    private NoticiaService noticiaService;

    @GetMapping("/newslist")
    public String inicio(Model model) {
        var noticias = noticiaService.getNoticias();
        model.addAttribute("Noticias", noticias);
        return "/noticia/newslist";
    }

    @GetMapping("/listado")
    public String inicio2(Model model) {
        var noticias = noticiaService.getNoticias();
        model.addAttribute("Noticias", noticias);
        return "/noticia/listado";
    }

    @GetMapping("/eliminar/{id}")
    public String notiEliminar(Noticia noticia) {
        noticiaService.delete(noticia);
        return "redirect:/noticia/listado";
    }

    @GetMapping("/modificar/{id}")
    public String notiModificar(Noticia noticia, Model model) {
        noticia = noticiaService.getNoticia(noticia);
        model.addAttribute("Noticia", noticia);
        return "/noticia/mods";
    }

    private static final String UPLOAD_DIR = "src/main/resources/static/images/subidas";

    private final ResourceLoader resourceLoader;

    public NoticiasController(ResourceLoader resourceLoader) {
        this.resourceLoader = resourceLoader;
    }

    @PostMapping("/guardar")
    public String notiGuardar(@RequestParam String titulo, @RequestParam String cuerpo, @RequestParam("imagen") MultipartFile file) throws IOException {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        Path path = Paths.get(UPLOAD_DIR + "/" + fileName);
        Files.write(path, file.getBytes());

        Noticia noticia = new Noticia();
        noticia.setImagen("images/subidas/" + fileName);  // Aquí asignamos la ruta relativa de la imagen
        noticia.setTitulo(titulo);
        noticia.setCuerpo(cuerpo);
        noticiaService.save(noticia);

        return "redirect:/noticia/newslist";
    }
    
    @PostMapping("/guardar2/{id}")
    public String notiGuardar2(@PathVariable String id,@RequestParam String titulo,@RequestParam String cuerpo,@RequestParam("imagen") MultipartFile file) throws IOException {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        Path path = Paths.get(UPLOAD_DIR + "/" + fileName);
        Files.write(path, file.getBytes());

        Noticia noticia = new Noticia();
        noticia.setId(Long.valueOf(id)); // Establecer el ID del tutorial
        noticia.setImagen("images/subidas/" + fileName); // Asignamos la ruta relativa de la imagen
        noticia.setTitulo(titulo);
        noticia.setCuerpo(cuerpo);

        noticiaService.save(noticia); // Guardar el tutorial con la nueva imagen

        return "redirect:/noticia/newslist";
    }
    

    @GetMapping("/images/subidas/{imageName:.+}")
    public ResponseEntity<Resource> getImage(@PathVariable String imageName) {
        try {
            Resource fileResource = resourceLoader.getResource("classpath:static/" + imageName);
            if (fileResource.exists()) {
                return ResponseEntity.ok()
                        .contentType(MediaType.IMAGE_PNG) // Cambia el tipo de media según el tipo de imagen que estés utilizando
                        .body(fileResource);
            } else {
                return ResponseEntity.notFound().build();
            }
        } catch (Exception e) {
            return ResponseEntity.notFound().build();
        }
    }
}
