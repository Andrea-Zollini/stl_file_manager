<script setup>
import * as THREE from "three";
import { ref, onMounted, watch } from "vue";
const el = ref(null);

const props = defineProps({
    file: Object,
});

let camera = null;
let scene = null;
let renderer = null;

const displayFile = () => {
    const renderArea = el.value;
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
    );

    renderer = new THREE.WebGLRenderer();
    renderer.setSize(1200, 800);
    renderArea.appendChild(renderer.domElement);

    const geometry = new THREE.BoxGeometry(1, 1, 1);
    const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
    const cube = new THREE.Mesh(geometry, material);
    scene.add(cube);

    camera.position.z = 5;

    function animate() {
        requestAnimationFrame(animate);

        cube.rotation.x += 0.01;
        cube.rotation.y += 0.01;

        renderer.render(scene, camera);
    }

    animate();
};

const destroyScene = () => {
    if (renderer) {
        renderer.domElement.remove();
    }
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
                    displayFile();
                }
            }
        }
    );
});
</script>

<template>
    <div class="" ref="el"></div>
</template>
