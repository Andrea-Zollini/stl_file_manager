<script setup>
import * as THREE from "three";
import { STLLoader } from "three/examples/jsm/loaders/STLLoader";
import { OrbitControls } from "three/examples/jsm/controls/OrbitControls";
import { ref, onMounted, watch } from "vue";
const el = ref(null);

const props = defineProps({
    file: Object,
});

// let camera = null;
// let scene = null;
// let renderer = null;

// const displayFile = () => {
//     const renderArea = el.value;
//     scene = new THREE.Scene();
//     camera = new THREE.PerspectiveCamera(
//         75,
//         window.innerWidth / window.innerHeight,
//         0.1,
//         1000
//     );

//     renderer = new THREE.WebGLRenderer();
//     renderer.setSize(1200, 800);
//     renderArea.appendChild(renderer.domElement);

//     const geometry = new THREE.BoxGeometry(1, 1, 1);
//     const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
//     const cube = new THREE.Mesh(geometry, material);
//     scene.add(cube);

//     camera.position.z = 5;

//     function animate() {
//         requestAnimationFrame(animate);

//         cube.rotation.x += 0.01;
//         cube.rotation.y += 0.01;

//         renderer.render(scene, camera);
//     }

//     animate();
// };

const destroyScene = () => {
    if (renderer) {
        renderer.domElement.remove();
    }
};

let scene, camera, renderer, object;

function init() {
    const renderArea = el.value;
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xf3f4f6);
    camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
    );
    camera.position.z = 10;

    renderer = new THREE.WebGLRenderer();
    renderer.setSize(1200, 800);
    renderArea.appendChild(renderer.domElement);

    scene.add(object);

    let controls = new OrbitControls(camera, renderer.domElement);
    let light = new THREE.DirectionalLight(0xffffff);
    light.position.set(0, 0, 10);
    scene.add(light);
    let light2 = new THREE.DirectionalLight(0xffffff);
    light2.position.set(0, 0, -10);
    scene.add(light2);
    animate();
}

const animate = () => {
    requestAnimationFrame(animate);
    object.rotation.z += 0.0;
    renderer.render(scene, camera);
};

const loadSTL = (fileName) => {
    const fileURL = URL.createObjectURL(
        new Blob([fileName], { type: "model/stl" })
    );
    let loader = new STLLoader();
    loader.load(fileURL, (model) => {
        object = new THREE.Mesh(model, new THREE.MeshLambertMaterial(0x00ff00));
        object.scale.set(0.15, 0.15, 0.15);
        object.position.set(0, 0, 0);
        init();
    });
};

onMounted(() => {
    watch(
        () => props.file,
        (newValue, oldValue) => {
            if (newValue !== oldValue) {
                if (oldValue) {
                    destroyScene();
                }
                if (newValue) {
                    // displayFile();
                    loadSTL(newValue);
                    // console.log(fileURL);
                }
            }
        }
    );
});
</script>

<template>
    <div class="" ref="el"></div>
</template>
